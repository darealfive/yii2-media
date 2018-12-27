<?php
/**
 * Index class file
 */

namespace darealfive\media\controllers\actions;

use darealfive\base\interfaces\Searchable;
use darealfive\media\controllers\Controller;
use Yii;

/**
 * Class Index
 *
 * @package darealfive\media\controllers\actions
 *
 * @property-read Searchable $model
 */
abstract class Index extends Action
{
    /**
     * @var Searchable
     */
    private $searchable;

    /**
     * Index constructor.
     *
     * @param string     $id
     * @param Controller $controller
     * @param Searchable $searchable
     * @param array      $config
     */
    public function __construct(string $id, Controller $controller, Searchable $searchable, array $config = [])
    {
        parent::__construct($id, $controller, $config);
        $this->searchable = $searchable;
    }

    /**
     * Lists all data behind Searchable object.
     *
     * @return mixed
     */
    public function run()
    {
        return $this->controller->render($this->controller::INDEX, [
            'searchModel'  => $this->searchable,
            'dataProvider' => $this->searchable->search(Yii::$app->request->queryParams),
        ]);
    }
}