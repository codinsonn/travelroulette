<?php
require_once WWW_ROOT . 'controller' . DS . 'AppController.php';

class PagesController extends AppController {

	public function __construct()
	{
		require_once WWW_ROOT . 'dao' . DS . 'PreferencesDAO.php';
		$this -> preferencesDAO = new PreferencesDAO();

		require_once WWW_ROOT . 'dao' . DS . 'ClientsDAO.php';
		$this -> clientsDAO = new ClientsDAO();
	}

	public function onepager() {
		
		/* ---- Pagination -------------------------------------------------- */

		switch ($_GET['p']) {
			case 'step1':
				$this -> set('pageClass', "Step1TravelStylesPage");
				$this -> set('scrollClass', "noScroll");
				$this -> set('pageIndex', 1);
				$this -> step1Actions();
				break;
			case 'step2':
				$this -> set('pageClass', "Step2InterestsPage");
				$this -> set('scrollClass', "noScroll");
				$this -> set('pageIndex', 2);
				$this -> step2Actions();
				break;
			case 'step3':
				$this -> set('pageClass', "Step3LocationsPage");
				$this -> set('scrollClass', "scrollable");
				$this -> set('pageIndex', 3);
				$this -> step3Actions();
				break;
			case 'wrapUp':
				$this -> set('pageClass', "WrapUpPage");
				$this -> set('scrollClass', "noScroll");
				$this -> set('pageIndex', 4);
				$this -> wrapUpActions();
				break;
			case 'home':
			default:
				$this -> set('pageClass', "IntroPage");
				$this -> set('scrollClass', "noScroll");
				$this -> set('pageIndex', 0);
				break;
		}

		/* ---- Data --------------------------------------------------------- */

		$travelstyles = $this -> preferencesDAO -> getTravelStyles();
		$this -> set('travelstyles', $travelstyles);

		$interests = $this -> preferencesDAO -> getInterests();
		$this -> set('interests', $interests);

		$locales = $this -> preferencesDAO -> getLocales();
		$this -> set('locales', $locales);

	}

	public function step1Actions() {

		if(!empty($_POST)){

			if(empty($_POST['travelstyles']) && empty($_SESSION['travelstyles'])){
				$this -> addError('travelstyles', "Must have at least one travelstyle selected.");
			}else if(empty($_POST['travelstyles']) && !empty($_SESSION['travelstyles'])){
				$_POST['travelstyles'] = $_SESSION['travelstyles'];
			}

			if($this -> checkErrors() == false){

				$_SESSION['travelstyles'] = $_POST['travelstyles'];

				if($_POST['submitTravelstyles'] == "Save and Proceed"){
					redirect('index.php?p=step2');
				}

			}

		}

	}

	public function step2Actions() {

		if(!empty($_POST)){

			if(empty($_POST['interests']) && empty($_SESSION['interests'])){
				$this -> addError('interests', "Must have at least five interest selected.");
			}else if(empty($_POST['interests']) && !empty($_SESSION['interests'])){
				$_POST['interests'] = $_SESSION['interests'];
			}

			/*if(count($_POST['interests']) < 5){
				$this -> addError('interests', "Must have at least five interest selected.");
			}*/

			if($this -> checkErrors() == false){

				$_SESSION['interests'] = $_POST['interests'];

				if($_POST['submitInterests'] == "Save and Proceed"){
					redirect('index.php?p=step3');
				}

			}

		}

	}

	public function step3Actions() {

		if(!empty($_POST)){

			if(empty($_POST['locales']) && empty($_SESSION['locales'])){
				$this -> addError('locales', "Must have at least one locale selected.");
			}else if(empty($_POST['locales']) && !empty($_SESSION['locales'])){
				$_POST['locales'] = $_SESSION['locales'];
			}

			if($this -> checkErrors() == false){

				$_SESSION['locales'] = $_POST['locales'];

				if($_POST['submitLocales'] == "Save and Finish"){
					redirect('index.php?p=wrapUp');
				}

			}

		}

	}

	public function wrapUpActions() {

		if(!empty($_POST['submitUseInfo'])){

			if(empty($_POST['txtFullname'])){
				$this -> addError('txtFullname', "Please fill in your full name.");
			}

			if(empty($_POST['txtEmail'])){
				$this -> addError('txtEmail', "Please fill in your email adress.");
			}elseif(!filter_var($_POST['txtEmail'], FILTER_VALIDATE_EMAIL)){
				$this -> addError('txtEmail', "Please fill in a valid email adress.");
			}

			if($this -> checkErrors() == false){

				$_SESSION['client'] = $this -> clientsDAO -> insertClient($_POST['txtFullname'], $_POST['txtEmail'], 0);
				$client_id = $_SESSION['client']['id'];

				if(!empty($client_id)){
					$this -> preferencesDAO -> insertClientTravelstyles($client_id, $_SESSION['travelstyles']);
					$this -> preferencesDAO -> insertClientInterests($client_id, $_SESSION['interests']);
					$this -> preferencesDAO -> insertClientLocales($client_id, $_SESSION['locales']);

					redirect('index.php?p=result');
				}

			}

		}

	}

	public function resultPage() {

		

	}

}