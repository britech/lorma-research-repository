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
				'actions'=>array('index', 'view', 'search', 'file', 'downloadFile', 
							     'searchByKeyword', 'searchByDepartment','searchAuthors', 'searchKeywords', 'search'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create', 'delete', 'update',
								 'author', 'enlistAuthor', 'updateAuthor', 'deleteAuthor',
								 'folder', 'assignFolder', 'removeFolder',
								 'file', 'downloadFile', 'updateFile', 'deleteFile',
								 'keyword', 'addKeyword', 'updateKeyword', 'deleteKeyword'),
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
			if($model->validate() && $model->save())
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
		$dataProvider=new CActiveDataProvider('Publication', array('criteria'=>array('order'=>'fld_date_stored DESC')));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Publication the loaded model
	 * @throws CHttpException
	 */
	private function loadModel($id)
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
	
	public function actionRemoveFolder($id){
		$tempModel=$this->loadFileGroupModel($id);
		$publication=$tempModel->key_pub;
		
		$this->loadFileGroupModel($id)->delete();
		
		$this->redirect(array('view','id'=>$publication));
	}
	
	/**
	 * @return FileGroup
	 */
	private function loadFileGroupModel($id){
		$model=FileGroup::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	//file component
	public function actionFile($publication){
		//$publicationModel=$this->loadModel($publication);
		
		$formModel=new File();
		$formModel->key_pub=$publication;
		
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
				//'model'=>$publicationModel,
				'fileGroup'=>$fileGroupList,
				'formModel'=>$formModel,
				'folderList'=>$folderList,
				'gridModel'=>new File()
		));
	}

	public function actionUpdateFile($id){
		$formModel=$this->loadFileModel($id);
		
		if(isset($_POST['File'])){
			$formModel->attributes = $_POST['File'];
			
			if($formModel->validate()){
				$formModel->save();
				$this->redirect(array('file','publication'=>$formModel->publication->key_pub));
			}
		}
		
		$fileGroupList=FileGroup::model()->findAllBySql('SELECT key_pub_folder, t1.key_folder_group, key_pub, fld_group_name
				FROM tbl_pub_folder t1
				JOIN tbl_folder_group t2 ON t1.key_folder_group=t2.key_folder_group
				WHERE key_pub=:pub ORDER BY fld_order ASC', array(':pub'=>$formModel->key_pub));
		
		$folderList=CHtml::listData($fileGroupList,'FolderId','FolderName');
		
		$this->layout="profile";
		$this->render('manageFile', array(
				//'model'=>$publicationModel,
				'fileGroup'=>$fileGroupList,
				'formModel'=>$formModel,
				'folderList'=>$folderList,
				'gridModel'=>new File()
		));
	}

	public function actionDeleteFile($id){
		$fileModel=$this->loadFileModel($id);
		$repoDirectory=Yii::getPathOfAlias('application.repository');
		
		unlink($repoDirectory.'/pub-'.$fileModel->key_pub.'/folder-'.$fileModel->folder->key_folder_group.'/'.$fileModel->fld_filename);
		$fileModel->delete();
	}
	
	public function actionDownloadFile($id){
		$data = $this->loadFileModel($id);
		$repoDirectory=Yii::getPathOfAlias('application.repository');
		$fullPath = $repoDirectory.'/pub-'.$data->key_pub.'/folder-'.$data->folder->key_folder_group.'/';
		if($data->fld_dload_restriction!=File::RESTRICTION_DLOAD_UNAUTH){
			if(Yii::app()->user->isGuest){
				Yii::app()->user->setFlash("notif", "To download this file, please login to Lorma Colleges Online Research Repository. If you're not registered, please click the 'Sign Up' link to get a free account.");
				$this->redirect(array("site/login"));
			} else{
				$this->sendDownloadedFile($fullPath, $data);
			}
		} else{
			$this->sendDownloadedFile($fullPath, $data);
		}
	}

	private function sendDownloadedFile($fullPath, $data){
		Yii::app()->getRequest()->sendFile($data->fld_filename, file_get_contents($fullPath.$data->fld_filename));
	}
	
	/**
	 * @return File
	 */
	private function loadFileModel($id){
		$model=File::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
	
	public function actionUpdateKeyword($id){
		$model=$this->loadKeywordModel($id);
		
		if(isset($_POST['Keyword'])){
			$model->attributes=$_POST['Keyword'];
			$model->fld_keyword=ucwords(strtolower($model->fld_keyword));
			$model->save();
			$this->redirect(array('keyword', 'publication'=>$model->key_pub));
		}
			
		
		$this->layout="profile";
		$this->render('manageKeyword', array(
				'model'=>$model,
				'gridModel'=>new Keyword(),
		));
	}
	
	public function actionDeleteKeyword($id){
		$this->loadKeywordModel($id)->delete();
	}
	
	/**
	 * @return Keyword
	 */
	private function loadKeywordModel($id){
		$model=Keyword::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	
	/**
	 * search mechanisms - Search By Keyword
	 */
	public function actionSearchByKeyword($keyword){
		$criteria=new CDbCriteria;
		$criteria->with=array('publication');
		$criteria->condition="fld_keyword=:keyword";
		$criteria->params=array(':keyword'=>$keyword);
		$criteria->order="fld_pub_title ASC";
		
		$dataProvider = new CActiveDataProvider(Keyword::model(), array('criteria'=>$criteria));
		
		$this->layout="column2";
		
		$this->render("keywordSearch", array('dataProvider'=>$dataProvider));
	}

	/**
		search mechanisms - Search By Department
	**/
	public function actionSearchByDepartment($department){
		$criteria=new CDbCriteria;
		$criteria->with=array('department');
		$criteria->condition="t.key_dept=:dept";
		$criteria->params=array(':dept'=>$department);
		$criteria->order="fld_pub_title ASC";
		
		$dataProvider = new CActiveDataProvider(Publication::model(), array('criteria'=>$criteria));
		$departmentName = Department::model()->findByPk($department)->fld_name;

		$this->layout="column2";
		
		$this->render("departmentSearch", array('dataProvider'=>$dataProvider, 'name'=>$departmentName));
	}
	
	/**
	 * search utility function - Author's Surname list loading
	 */
	public function actionSearchAuthors(){
		$lastName = $_POST['lastName'];
		$rawResult = Author::model()->findAllBySql('SELECT DISTINCT(fld_lname) as fld_lname FROM tbl_pub_author 
													WHERE fld_lname LIKE :l1 OR fld_lname LIKE :l2 OR fld_lname LIKE :l3', 
												    array(':l1'=>$lastName.'%', ':l2'=>'%'.$lastName, ':l3'=>'%'.$lastName.'%'));
		$results = array();
		
		foreach($rawResult as $result){
			array_push($results, array('id'=>$result->fld_lname, 'name'=>$result->fld_lname));
		}
	
		header("Content-type: application/json");
		echo json_encode($results);
		Yii::app()->end();	
	}
	
	/**
	 * search utility function - Keywords list loading
	 */
	public function actionSearchKeywords(){
		$keyword = $_POST['keyword'];
		$rawResult = Keyword::model()->findAllBySql('SELECT DISTINCT(fld_keyword) FROM tbl_pub_keyword
													WHERE fld_keyword LIKE :k1 OR fld_keyword LIKE :k2 OR fld_keyword LIKE :k3',
				array(':k1'=>$keyword.'%', ':k2'=>'%'.$keyword, ':k3'=>'%'.$keyword.'%'));
		$results = array();
	
		foreach($rawResult as $result){
			array_push($results, array('id'=>$result->fld_keyword, 'name'=>$result->fld_keyword));
		}
	
		header("Content-type: application/json");
		echo json_encode($results);
		Yii::app()->end();
	}
	
	/**
	 * search mechanism - General Search
	 */
	public function actionSearch(){
		$dataProvider = new CActiveDataProvider('Publication');
		$model = new SearchCriteria();
		$deptList = CHtml::listData(Department::model()->findAll(), 'key_dept', 'DepartmentLabel');
	
		if(isset($_POST['SearchCriteria'])){
			$rawInput = new SearchCriteria();
			$rawInput->attributes = $_POST['SearchCriteria'];
			
			$criteria = new CDbCriteria();
			$criteria->distinct=true;
			$criteria->together=true;
			$criteria->with=array('department', 'authors', 'keywords');
			
			//$criteria->condition="t.key_dept=:dept";
			
			$parameterIds = array();
			$parameterValues = array();
			
			//append the title condition if inputted
			if(!empty($rawInput->publicationTitle)){
				$criteria->compare('t.fld_pub_title', $rawInput->publicationTitle, true);
			}
			
			//append the lastnames condition if inputted
			if(!empty($rawInput->authorLastNames)){
				$criteria->addInCondition('authors.fld_lname', explode('+',$rawInput->authorLastNames));
			}

			//append the keywords condition if inputted
			if(!empty($rawInput->keywords)){
				$criteria->addInCondition('keywords.fld_keyword', explode('+', $rawInput->keywords));
			}
			
			$criteria->addColumnCondition(array('t.key_dept'=>$rawInput->departmentOfOrigin));
			$pageSize = $rawInput->limit!='*' ? $rawInput->limit : -1;
			
			$dataProvider = new CActiveDataProvider(Publication::model(), array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>$pageSize)));
		}
		$this->layout="column1";
		$this->render('search', array('dataProvider'=>$dataProvider, 'model'=>$model, 'deptList'=>$deptList));
	}
}
