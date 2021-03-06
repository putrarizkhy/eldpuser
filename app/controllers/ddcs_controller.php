<?php
class DdcsController extends AppController {

	var $name = 'Ddcs';
	var $helpers = array('Html', 'Form');

	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('*');
	}
	
	function index() {
		$this->Ddc->recursive = 0;
		$this->set('ddcs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Ddc.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('ddc', $this->Ddc->read(null, $id));
	}


	

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Ddc', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Ddc->del($id)) {
			$this->Session->setFlash(__('Ddc deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	function admin_listddc(){
		$this->Ddc->recursive = 0;
		$listddc = $this->Ddc->find('all');
		$this->set('listddc',$listddc);
		$this->layout = 'default_blank';
	}


	function admin_add() {
		if (!empty($this->data)) {
			$this->Ddc->create();
			if ($this->Ddc->save($this->data)) {
				$status = "true";
				$lastID  = $this->Ddc->getInsertID();
				//$this->set('ebookID', $lastID);
				$this->redirect(array('action'=>'add_responses',$lastID,$status));
				
			} else {
				$status = "false";
				$this->redirect(array('action'=>'add_responses',$lastID,$status));
				/*$this->Session->setFlash('Data tidak berhasil disimpan, silahkan coba lagi','flash_erorr');
				$this->redirect(array('action'=>'index'));*/
			}
		}
		$this->layout = 'default_blank';
	}

	function admin_add_responses($id,$status){
		if (!$id && !$status) {
			$this->Session->setFlash(__('Invalid Ddc.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('entry', $this->Ddc->read(null, $id));
		$this->layout = 'default_blank';
	}



	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Ddc', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Ddc->save($this->data)) {
				$status = "true";
				$flashMessage = "Berhasil Mengedit Data";
				$idtoResponse = $this->data['Ddc']['id'];
				$this->redirect(array('action'=>'edit_responses',$idtoResponse,$status,$flashMessage));
			} else {
				$status = "false";
				$flashMessage = "Tidak Berhasil Mengedit Data";
				$idtoResponse = 0;
				$this->redirect(array('action'=>'edit_responses',$idtoResponse,$status,$flashMessage));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ddc->read(null, $id);
		}
		$this->set('ddc', $this->Ddc->read(null, $id));
		$this->layout = 'default_blank';
	}


	function admin_edit_responses($id,$status,$flashMessage){
		
		if (!$id && !$status) {
			$this->Session->setFlash(__('Invalid Ddc.', true));
			$this->redirect(array('action'=>'index'));
		}

		$this->set('entry', $this->Ddc->read(null, $id));
		$this->set(compact('status','flashMessage'));
		$this->layout = 'default_blank';

		
	}


	function admin_delete($id = null) {
		$status = "false";
		$flashMessage = "";
		$idtodelete = "";
		if (!$id) {
			$status = "false";
			$flashMessage = "Tidak Berhasil Menghapus";
			$idtodelete = "";
			//$this->Session->setFlash('Tidak Berhasil Menghapus','flash_erorr');
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Ddc->del($id)) {
			//$directory = WWW_ROOT.'files'.DS.'ebooks'.DS.$id;
			//$this->_delete_recursive($directory);

			$status = "true";
			$flashMessage = "Berhasil Menghapus";
			$idtodelete = $id;
			//$this->Session->setFlash('Berhasil Menghapus','flash_success');
			//$this->redirect(array('action'=>'index'));

		}
		$this->set(compact('status','flashMessage','idtodelete'));
		$this->layout = 'default_blank';
		
	}

}
?>