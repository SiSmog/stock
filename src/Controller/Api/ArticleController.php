<?php
declare(strict_types=1);

namespace App\Controller\Api;
use App\Controller\AppController;

/**
 * Article Controller
 *
 * @property \App\Model\Table\ArticleTable $Article
 */
class ArticleController extends AppController
{
public function initialize(): void
    {
        
        parent::initialize();

        $this->loadModel("Article");
    }

    // Add article api
    public function addArticle()
    {
        $this->request->allowMethod(["post"]);

        // form data
        $formData = $this->request->getData();
        $artData = $this->Article->find()->where([
            "barcode" => $formData['barcode']
        ])->first();        

            // insert new article
            $artObject = $this->Article->newEmptyEntity();

            $artObject = $this->Article->patchEntity($artObject, $formData);
            if (!empty($artData)) {
                // already exists
                $status = false;
                $message = "Article already exists";
            } else {
                if ($this->Article->save($artObject)) {
                    // success response
                    $status = true;
                    $message = "Article has been created";
                } else {
                    // error response
                    $status = false;
                    $message = "Failed to create article";
                }
            }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // List employees api
    public function listArticle()
    {
        $this->request->allowMethod(["get"]);

        $article = $this->Article->find()->toList();

        $this->set([
            "status" => true,
            "message" => "Article list",
            "data" => $article
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }
    public function listArticleById()
    {
        $art_id = $this->request->getParam("barcode");

        $this->request->allowMethod(["get"]);

        $article = $this->Article->find('all')->where(["barcode"=>$art_id])->first();

        $this->set([
            "status" => true,
            "message" => "Article list",
            "data" => $article
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Update article
    public function updateArticle()
    {
        $this->request->allowMethod(["put", "post"]);

        $art_id = $this->request->getParam("barcode");

        $articleInfo = $this->request->getData();

        // article check
        $article = $this->Article->get($art_id);

        if (!empty($article)) {
            // articles exists
            $article = $this->Article->patchEntity($article, $articleInfo);

            if ($this->Article->save($article)) {
                // success response
                $status = true;
                $message = "Article has been updated";
            } else {
                // error response
                $status = false;
                $message = "Failed to update article";
            }
        } else {
            // article not found
            $status = false;
            $message = "Article Not Found";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Delete article api
    public function deleteArticle()
    {
        $this->request->allowMethod(["delete"]);
        
        $art_id = $this->request->getParam("barcode");

        $article = $this->Article->get($art_id);

        if (!empty($article)) {
            // article found
            if ($this->Article->delete($article)) {
                // article deleted
                $status = true;
                $message = "Article has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete article";
            }
        } else {
            // not found
            $status = false;
            $message = "Article doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }
}
