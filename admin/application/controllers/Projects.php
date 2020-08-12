<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends CI_Controller {
    function __construct() {
        parent::__construct();
        access();
    }

    function search() {
        $this->load->view('projects/search');
    }

    function feed() {

        $page = (isset($_GET['page']) ? $_GET['page']: 1);

        $data['projects'] = $this->db->select("projects.*")
                                    ->order_by('projects.id', "DESC")
                                    ->get('projects')->result_array();




        $count_db = clone $this->db;
        $count = $count_db->count_all_results('projects');
        $data['pages'] = pages($count ,$page);

        j(["status" => "ok","data" => $data]);

    }

    function edit() {
        $errors = [];
        $pProject = [];
        $pProject = (isset($_POST['project']) ? $_POST['project'] : []);

		if(!isset($pProject['title']) || $pProject['title'] == '' || $pProject['title'] == null) {
			$errors[] = "Title can't be empty.";
        }

        if(!isset($pProject['content']) || $pProject['content'] == '' || $pProject['content'] == null) {
			$errors[] = "Project description can't be empty.";
        }

        if(!isset($pProject['keywords']) || $pProject['keywords'] == '' || $pProject['keywords'] == null) {
			$errors[] = "Please add at least 1 keyword";
        }

        if(!isset($pProject['degree']) || $pProject['degree'] == '' || $pProject['degree'] == null) {
			$errors[] = "Please select a degree";
        }

		if(!isset($pProject['author']) || $pProject['author'] == '' || $pProject['author'] == null) {
			$errors[] = "Author can't be empty.";
        }

        if(!$errors) {
            $project = [
                'user' => $_SESSION['user']['id'],
                'title' => $pProject['title'],
                // 'status' => "open"
                'content' => ($pProject['content'] ?? null ),
                'author' => $pProject['author'],
                'keywords' => ($pProject['keywords'] ?? null ),
                'degree' => $pProject['degree']

            ];

            if(isset($pProject['id'])) {
				$project['updated'] = stamp();
                $this->db->where('id',$pProject['id'])->set($project)->update('projects');

                // //Update attachements
                // $this->db->where('attachements.entry_id', $pProject['id'])->delete('attachements');

                // foreach($_POST['photos'] as $photo) {
                //     $attachements[] = [
                //         "user" => $_SESSION['user']['id'],
                //         "file" => $photo['id'],
                //         "entry" => "projects",
                //         "entry_id" => $pProject['id'],
                //         "created" =>  stamp(),
                //         "updated" => stamp()
                //     ];
                // }

                // $this->db->insert_batch('attachements', $attachements);
                j(['status' => "ok" , "data" => null]);

			} else {
				$project['created'] = stamp();
				$project['updated'] = stamp();
                $this->db->insert('projects', $project);
                $projectId =  $this->db->insert_id();

                // foreach($_POST['photos'] as $photo) {

                //     $attachements[] = [
                //         "user" => $_SESSION['user']['id'],
                //         "file" => $photo['id'],
                //         "entry" => "projects",
                //         "entry_id" => $projectId,
                //         "created" =>  stamp(),
                //         "updated" => stamp()
                //     ];
                // }

                // $this->db->insert_batch('attachements', $attachements);

				j(['status' => "ok" , "data" => null]);
			}
        } else {
            j(["status" => "error","data" => $errors]);
        }


    }

    function get($id = null) {
        if($id) {
            $data['project'] = $this->db->select('projects.*')
                                    ->where("projects.id", $id)
                                    ->get('projects')->row_array();

            // $data['photos'] = $this->db->select('attachements.file as id, files.path, files.name, files.file_name')
            //                                 ->join("files", "attachements.file=files.id", "left")
            //                                 ->where('attachements.entry', 'projects')
            //                                 ->where('attachements.entry_id',  $data['project']['id'])
            //                                 ->get('attachements')->result_array();

            j(['status' => "ok","data" => $data]);

        }
    }

    function remove() {
		access();
		if(isset($_POST['project'])) {

            $this->db->where('id', $_POST['project']['id'])->delete('projects');
            $this->db->where('entry_id', $_POST['project']['id'])->delete('attachements');

			j(['status' => "ok"]);
		}
    }

    function set_status() {
        access();
		if(isset($_POST['project'])) {

            $project = $this->db->where('id', $_POST['project']['id'])->get('projects')->row_array();

            if($project['status'] == "open") {
                $this->db->where('id',$_POST['project']['id'])->set('status', 'closed')->update('projects');
                j(['status' => "ok", "data" => false]);

            } else if($project['status'] == "closed") {
                $this->db->where('id',$_POST['project']['id'])->set('status', "open")->update('projects');
                j(['status' => "ok", "data" => true]);

            } else {
                j(['status' => "error"]);
            }

		}
    }

    function count_projects() {
		$data['projects_count'] = $this->db->count_all_results('projects');

		j(['status' => "ok","data" => $data]);
	}
}
