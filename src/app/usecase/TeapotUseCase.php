<?php
namespace app\usecase;

use app\entity\TeaPot;
use app\model\errors\QueryExecutionException;
use app\model\TeaPotModel;
use app\utils\Encoder;
use PDOException;

class TeapotUseCase
{
    private TeaPotModel $teapotModel;
    private Encoder $encoder;

    public function __construct(TeaPotModel $teapotModel, Encoder $encoder)
    {
        $this->teapotModel = $teapotModel;
        $this->encoder     = $encoder;
    }

    /**
     * @return TeaPot
     */
    public function createTeapotFromPostParams(): TeaPot
    {
        $id = (isset($_POST['id'])) ? $_POST['id'] : null;
        return new TeaPot($id, $_POST['brand'] . ' ' . $_POST['model_name'], $_POST['description'], $_POST['cost'], $_POST['stock_balance']);

    }

    public function getTeaPotsList()
    {
        try {
            return $this->encoder->getJSONEncoddedAnswer(success: true, data: $this->teapotModel->getAll());
        }
        catch (PDOException | QueryExecutionException $ex) {
            return $this->encoder->getJSONEncoddedAnswer(message: $ex->getMessage());
        }
    }

    public function addTeaPot()
    {
        $teaPot = $this->createTeapotFromPostParams();
        try {
            $this->teapotModel->create($teaPot);
            return $this->encoder->getJSONEncoddedAnswer(success: true, message: "Чайник добавлен");
        }
        catch (QueryExecutionException $ex) {
            return $this->encoder->getJSONEncoddedAnswer(message: $ex->getMessage());
        }
    }

    public function update()
    {
        $teaPot = $this->createTeapotFromPostParams();
        try {
            $this->teapotModel->update($teaPot);
            return $this->encoder->getJSONEncoddedAnswer(success: true, message: "Чайник изменен");
        }
        catch (QueryExecutionException $ex) {
            return $this->encoder->getJSONEncoddedAnswer(message: $ex->getMessage());
        }
    }

    public function deleteTeaPot()
    {
        try {
            $this->teapotModel->delete($_POST['id']);
            return $this->encoder->getJSONEncoddedAnswer(success: true, message: "Чайник удален");
        }
        catch (QueryExecutionException $ex) {
            return $this->encoder->getJSONEncoddedAnswer(message: $ex->getMessage());
        }
    }
}