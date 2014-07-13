<?php

class PublicationController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'delete',
								 'author', 'enlistAuthor', 'updateAuthor', 'deleteAuthor',
								 'folder', 'assignFolder',
								 'file', 'downloadFile',
								 'keyword', 'addKeyword'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout="profile";
		$model=$this->loadModel($id);
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Publication;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Publication']))
		{
			$model->attributes=$_POST['Publication'];
			$model->fld_date_stored=$model->assembleSqlDate($model->fld_date_stored);
			print_r($model->attributes);
			if($model->save())
				$this->redirect(array('view','id'=>$model->key_pub));
		}

		$deptList=CHtml::listData(Department::model()->findAll(), 'key_dept', 'DepartmentLabel');
		$this->render('create',array(
			'model'=>$model,
			'deptList'=>$deptList
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$oldDate=$model->fld_date_stored;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Publication']))
		{
			$model->attributes=$_POST['Publication'];
			$model->fld_date_stored=$model->assembleSqlDate(empty($model->fld_date_stored) ? $oldDate : $model->fld_date_stored);
			if($model->save())
				$this->redirect(array('view','id'=>$model->key_pub));
		}
		$deptList=CHtml::listData(Department::model()->findAll(), 'key_dept', 'DepartmentLabel');
		$this->render('update',array(
			'model'=>$model,
			'deptList'=>$deptList
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Publication');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Publication('searchByPublication');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Publication']))
			$model->attributes=$_GET['Publication'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Publication the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Publication::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Publication $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='publication-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	//author component
	public function actionAuthor($publication){
		$model=$this->loadModel($publication);
		$deptList=CHtml::listData(Department::model()->findAll(), 'key_dept', 'DepartmentLabel');
		
		$formModel=new Author();
		$formModel->key_dept=$model->key_dept;
		$formModel->key_pub=$publication;

		$gridModel=new Author();
		$gridModel->unsetAttributes();
		if(isset($_GET['Author'])){
			$gridModel->attributes=$_GET['Author'];
		}
			
		$deptFilterList=CHtml::listData(Department::model()->findAll(), 'key_dept', 'fld_name'); 
		$this->layout="profile";
		$this->render('manageAuthor', array(
				'model'=>$formModel,
				'deptList'=>$deptList,
				'gridModel'=>$gridModel
		));
	}
	
	public function actionEnlistAuthor($publication){
		$model=new Author;
		if(isset($_POST['Author'])){
			$model->attributes=$_POST['Author'];
			$model->fld_lname=ucwords(strtolower($model->fld_lname));
			$model->fld_fname=ucwords(strtolower($model->fld_fname));
			$model->fld_mname=ucwords(strtolower($model->fld_mname));
			
			Yii::app()->db->createCommand()->insert($model->tableName(), 
													array('fld_lname'=>$model->fld_lname,
														  'fld_fname'=>$model->fld_fname,
														  'fld_mname'=>$model->fld_mname,
														  'key_pub'=>$model->key_pub,
														  'key_dept'=>$model->key_dept));
		}
		$this->redirect(array('author', 'publication'=>$publication));
	}
	
	public function actionUpdateAuthor($id){
		$deptList=CHtml::listData(Department::model()->findAll(), 'key_dept', 'DepartmentLabel');
		
		$formModel=$this->loadAuthorModel($id);
		
		if(isset($_POST['Author'])){
			$formModel->attributes=$_POST['Author'];
			if($formModel->save()){
				$this->redirect(array('publication/author','publication'=>$formModel->key_pub));
			}
		}
		
		$this->layout="profile";
		$this->render('manageAuthor', array(
				'model'=>$formModel,
				'deptList'=>$deptList,
				'gridModel'=>new Author()
		));
	}
	
	public function actionDeleteAuthor($id){
		$tempModel=$this->loadAuthorModel($id);
		$publication=$tempModel->key_pub;
		
		$model=$this->loadAuthorModel($id);
		$model->delete();
		
		$this->redirect(array('author', 'publication'=>$publication));
	}
	
	/**
	 * @return Author
	 */
	private function loadAuthorModel($id){
		$model=Author::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	//file group component
	public function actionFolder($publication){
		$model=$this->loadModel($publication);
		
		$formModel=new FileGroup();
		$formModel->key_pub=$model->key_pub;
		
		$folderList=CHtml::listData(Folder::model()->findAllByAttributes(array(),'key_folder_group NOT IN(SELECT key_folder_group FROM tbl_pub_folder WHERE key_pub=:pub)', array(':pub'=>$publication)),
									'key_folder_group',
									'fld_group_name');
		
		$this->layout="profile";
		$this->render('manageFolder', array(
				'model'=>$formModel,
				'folderList'=>$folderList,
				'gridModel'=>new FileGroup()
		));
	}
	
	public function actionAssignFolder($publication){
		$model=new FileGroup();
		if(isset($_POST['FileGroup'])){
			$model->attributes=$_POST['FileGroup'];
			$model->save();
		}
		$this->redirect(array('folder','publication'=>$publication));
	}
	
	//file component
	public function actionFile($publication){
		$publicationModel=$this->loadModel($publication);
		
		$formModel=new File();
		$formModel->key_pub=$publicationModel->key_pub;
		
		if(isset($_POST['File'])){
			$formModel->attributes=$_POST['File'];
			if($formModel->validate()){
				
				//file upload handling
				$repoDirectory=Yii::getPathOfAlias('application.repository');
				$file=CUploadedFile::getInstance($formModel, 'fld_filename');
				if(!file_exists($repoDirectory.'/pub-'.$publication.'/folder-'.$formModel->key_folder_group.'/')){
					mkdir($repoDirectory.'/pub-'.$publication.'/folder-'.$formModel->key_folder_group.'/',0777,true);
				}
				$file->saveAs($repoDirectory.'/pub-'.$publication.'/folder-'.$formModel->key_folder_group.'/'.$file->getName());
				
				//save to db
				$formModel->fld_filename=$file->getName();
				$formModel->save();
				
				$this->redirect(array('file','publication'=>$publication));
			}
		}
		
		$fileGroupList=FileGroup::model()->findAllBySql('SELECT key_pub_folder, t1.key_folder_group, key_pub, fld_group_name 
				FROM tbl_pub_folder t1 
				JOIN tbl_folder_group t2 ON t1.key_folder_group=t2.key_folder_group 
				WHERE key_pub=:pub ORDER BY fld_order ASC', array(':pub'=>$publication));
		
		$folderList=CHtml::listData($fileGroupList,'FolderId','FolderName');
		
		$this->layout="profile";
		$this->render('manageFile', array(
				'model'=>$publicationModel,
				'fileGroup'=>$fileGroupList,
				'formModel'=>$formModel,
				'folderList'=>$folderList,
				'gridModel'=>new File()
		));
	}
	
	//keyword component
	public function actionKeyword($publication){
		$model=new Keyword();
		$model->key_pub=$publication;
		
		$this->layout="profile";
		$this->render('manageKeyword', array(
				'model'=>$model,
				'gridModel'=>new Keyword(),
		));
	}
	
	public function actionAddKeyword($publication){
		$model=new Keyword();
		if(isset($_POST['Keyword'])){
			$model->attributes=$_POST['Keyword'];
			$model->fld_keyword=ucwords(strtolower($model->fld_keyword));
			$model->save();
			/* Yii::app()->db->createCommand()->insert($model->tableName(), 
													array('fld_keyword'=>$model->fld_keyword)); */
		}
		$this->redirect(array('keyword', 'publication'=>$publication));
	}
}
