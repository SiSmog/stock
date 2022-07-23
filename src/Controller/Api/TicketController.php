<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Ticket Controller
 *
 * @property \App\Model\Table\TicketTable $Ticket
 */
class TicketController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Ticket");
    }

    // Add ticket api
    public function addTicket()
    {
        $this->request->allowMethod(["post"]);

        // form data
        $formData = $this->request->getData();

        $resData = $this->Ticket->find()->where([
            "ticketid" => $formData['ticketid']
        ])->first();        

            // insert new Ticket
            $resObject = $this->Ticket->newEmptyEntity();

            $resObject = $this->Ticket->patchEntity($resObject, $formData);
            if (!empty($resData)) {
                // already exists
                $status = false;
                $message = "Ticket already exists";
            } else {
                if ($this->Ticket->save($resObject)) {
                    // success response
                    $status = true;
                    $message = "Ticket has been created";
                } else {
                    // error response
                    $status = false;
                    $message = "Failed to create Ticket";
                }
            }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // List employees api
    public function listTicket()
    {
        $this->request->allowMethod(["get"]);

        $ticket = $this->Ticket->find()->toList();

        $this->set([
            "status" => true,
            "message" => "Ticket list",
            "data" => $ticket
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Update ticket
    public function updateTicket()
    {
        $this->request->allowMethod(["put", "post"]);

        $res_id = $this->request->getParam("ticketid");

        $ticketInfo = $this->request->getData();

        // ticket check
        $ticket = $this->Ticket->get($res_id);

        if (!empty($ticket)) {
            // tickets exists
            $ticket = $this->Ticket->patchEntity($ticket, $ticketInfo);

            if ($this->Ticket->save($ticket)) {
                // success response
                $status = true;
                $message = "Ticket has been updated";
            } else {
                // error response
                $status = false;
                $message = "Failed to update ticket";
            }
        } else {
            // ticket not found
            $status = false;
            $message = "Ticket Not Found";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Delete ticket api
    public function deleteTicket()
    {
        $this->request->allowMethod(["delete"]);
        
        $res_id = $this->request->getParam("ticketid");

        $ticket = $this->Ticket->get($res_id);

        if (!empty($ticket)) {
            // ticket found
            if ($this->Ticket->delete($ticket)) {
                // ticket deleted
                $status = true;
                $message = "Ticket has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete ticket";
            }
        } else {
            // not found
            $status = false;
            $message = "Ticket doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }
    public function deleteManyTicket()
    {
        $this->request->allowMethod(["delete"]);

        $res_id = $this->request->getParam("ticketid");

        $ticket = $this->Ticket->find('all')->where(['ticketid'=>$res_id]);
        if (!empty($ticket)) {
            // ticket found
            if ($this->Ticket->deleteMany($ticket)) {
                // ticket deleted
                $status = true;
                $message = "Ticket has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete ticket";
            }
        } else {
            // not found
            $status = false;
            $message = "Ticket doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

}
