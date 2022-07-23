<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Restock Controller
 *
 * @property \App\Model\Table\RestockTable $Restock
 */
class RestockController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Restock");
    }

    // Add restock api
    public function addRestock()
    {
        $this->request->allowMethod(["post"]);

        // form data
        $formData = $this->request->getData();


        // insert new Restock
        $resObject = $this->Restock->newEmptyEntity();

        $resObject = $this->Restock->patchEntity($resObject, $formData);

        if ($this->Restock->save($resObject)) {
            // success response
            $status = true;
            $message = "Restock has been created";
        } else {
            // error response
            $status = false;
            $message = "Failed to create Restock";
        }


        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // List employees api
    public function listRestock()
    {
        $this->request->allowMethod(["get"]);

        $restock = $this->Restock->find()->toList();

        $this->set([
            "status" => true,
            "message" => "Restock list",
            "data" => $restock
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Update restock
    public function updateRestock()
    {
        $this->request->allowMethod(["put", "post"]);

        $res_id = $this->request->getParam("restockid");

        $restockInfo = $this->request->getData();

        // restock check
        $restock = $this->Restock->get($res_id);

        if (!empty($restock)) {
            // restocks exists
            $restock = $this->Restock->patchEntity($restock, $restockInfo);

            if ($this->Restock->save($restock)) {
                // success response
                $status = true;
                $message = "Restock has been updated";
            } else {
                // error response
                $status = false;
                $message = "Failed to update restock";
            }
        } else {
            // restock not found
            $status = false;
            $message = "Restock Not Found";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Delete restock api
    public function deleteRestock()
    {
        $this->request->allowMethod(["delete"]);

        $res_id = $this->request->getParam("restockid");

        $restock = $this->Restock->get($res_id);

        if (!empty($restock)) {
            // restock found
            if ($this->Restock->delete($restock)) {
                // restock deleted
                $status = true;
                $message = "Restock has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete restock";
            }
        } else {
            // not found
            $status = false;
            $message = "Restock doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }
    public function deleteManyRestock()
    {
        $this->request->allowMethod(["delete"]);

        $res_id = $this->request->getParam("restockid");

        $restock = $this->Restock->find('all')->where(['restockid'=>$res_id]);
        if (!empty($restock)) {
            // restock found
            if ($this->Restock->deleteMany($restock)) {
                // restock deleted
                $status = true;
                $message = "Restock has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete restock";
            }
        } else {
            // not found
            $status = false;
            $message = "Restock doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }
}
