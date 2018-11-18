<?php
namespace app\admin\controller;

use app\admin\model\CityModel;
use cmf\controller\AdminBaseController;

class CityController extends AdminBaseController
{
    /*
     * 城市首页
     */
    public function index()
    {
        $cityModel = new CityModel();
        $data = $cityModel->paginate(15);
        $this->assign('data', $data);
        return $this->fetch();
    }

    /*
     * 添加城市页面
     */
    public function add()
    {
        return $this->fetch();
    }

    /*
     * 添加行为
     */
    public function addPost()
    {
        $data = $this->request->param();
        $cityModel = new CityModel();
        $result = $cityModel->allowField(true)->save($data);
        if (false === $result) {
            $this->error($cityModel->getError());
        }

        $this->success('添加成功！', url('city/index'));
    }

    /*
     * 修改页面
     */
    public function edit()
    {
        $id = $this->request->param('id', 0, 'intval');
        $cityModel = CityModel::get($id);
        $this->assign('data', $cityModel);

        return $this->fetch();
    }

    /*
     * 修改行为
     */
    public function editPost()
    {
        $data = $this->request->param();
        $cityModel = new CityModel();
        $result = $cityModel->allowField(true)->isUpdate(true)->save($data);
        if (false === $result) {
            $this->error($cityModel->getError());
        }

        $this->success('保存成功！', url('city/index'));
    }

    /*
     * 删除行为
     */
    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        CityModel::destroy($id);

        $this->success('删除成功！', url('city/index'));
    }

    /*
     * 排序
     */
    public function listOrder()
    {
        $linkModel = new  CityModel();
        parent::listOrders($linkModel);
        $this->success('排序更新成功！');
    }
}