<?php


namespace Controller;

use Core\Controller;


/**
 * Class ControllerArticle
 * I am standing on asphalt
 * With the skies on my feet
 * Either skis aren't running
 * Or I'm moron indeed
 * @package Controller
 */
class ControllerArticle extends Controller
{

    /**
     * Main action of the Article controller
     * Show all user's articles
     */
    public function actionIndex(): void
    {
        $this->loadModel('model_article');

        $data = $this->model_article->getArticlesByUserId($this->model_user->getId());

        $this->view->render(json_encode($data));

    }

    /**
     * Expects POST HTTP method
     * Create new article for user
     */
    public function actionCreate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST['title']) || empty($_POST['text'])) {

            header(sprintf("Location: %s", 'index.php?route=error/bad_request'));
        } else {
            $this->loadModel('model_article');
            $this->model_article->addArticle($_POST['title'], $_POST['text'], $this->model_user->getId());
            $data = 'Added: title - ' . $_POST['title'] . '; text - ' . $_POST['text'] . '; user_id - ' . $this->model_user->getId();

            $this->view->render(json_encode($data));
        }


    }

    /**
     * Expects PUT HTTP method
     * Create new article for user
     */
    public function actionUpdate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

            parse_str(file_get_contents('php://input'), $put_data);

            if (empty($put_data['title']) || empty($put_data['text']) || empty($put_data['article_id'])) {
                header(sprintf("Location: %s", 'index.php?route=error/bad_request'));
            } else {
                $this->loadModel('model_article');
                $this->model_article->updateArticle($put_data['article_id'], $put_data['title'], $put_data['text'], $this->model_user->getId());
                $data = 'Updated: article_id - ' . $put_data['article_id'] . '; title - ' . $put_data['title'] . '; text - ' . $put_data['text'] . '; user_id - ' . $this->model_user->getId();

                $this->view->render(json_encode($data));
            }
        }


    }

    /**
     * Expects DELETE HTTP method
     * Delete article by id
     */
    public function actionDelete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

            parse_str(file_get_contents('php://input'), $delete_data);

            if (empty($delete_data['article_id'])) {
                header(sprintf("Location: %s", 'index.php?route=error/bad_request'));
            } else {
                $this->loadModel('model_article');
                $this->model_article->deleteArticle($delete_data['article_id'], $this->model_user->getId());
                $data = 'Deleted: article_id - ' . $delete_data['article_id'] . '; user_id - ' . $this->model_user->getId();

                $this->view->render(json_encode($data));
            }
        }
    }
}
