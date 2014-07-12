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
				'actions'=>array('admin','delete','author','enlistAuthor'),
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
		$model=new Publication('search');
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
	
	
	public function actionAuthor($publication){
		$model=$this->loadModel($publication);
		$deptList=CHtml::listData(Department::model()->findAll(), 'key_dept', 'DepartmentLabel');
		
		$formModel=new Author();
		$formModel->key_dept=$model->key_dept;
		$formModel->key_pub=$publication;

		$gridModel=new Author('searchByPublication');
		$gridModel->unsetAttributes();  // clear any default values
		if(isset($_GET['Author']))
			$gridModel->attributes=$_GET['Author'];
		
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
}
