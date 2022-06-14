<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Repository\Clients\Category\ClientCategoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClientCategoryService
{

    private $repository;

    public function __construct(ClientCategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function findById($_id)
    {
        return $this->repository->findById($_id);
    }

    public function findBySlug($_slug)
    {
        return $this->repository->findBySlug($_slug);
    }

    public function getMenu()
    {
        return $this->repository->getMenu();
    }

    public function getListMenu($_data = [])
    {
        return self::groupListMenu($this->repository->getListMenu($_data), $_data);
    }

    public function groupListMenu($_data, $_params = [])
    {
        $arr = [];
        $arrFooter = [];
        $arrSupport = [];
        $arrService = [];
        foreach ($_data as $row) {
            if (empty($row->parent_id)) {
                if ($row->choose_1 == 1 || empty($row->type)) {
                    $arr['parent'][$row->id] = (array)$row;
                }
                if ($row->choose_2 == 1) {
                    $arrFooter[] = $row;
                }
                if ($row->choose_3 == 1) {
                    $arrSupport[] = $row;
                }
                if ($row->choose_4 == 1) {
                    $arrService[] = $row;
                }
            } else {
                $arr['list'][$row->parent_id][] = (array)$row;
            }
        }

        if (isset($_params['multi'])) {
            return [
                'select' => !empty($arr) ? self::mergeListMenu($arr, $_params) : '<option value="">' . (__('admins::layer.search.form.category')) . '</option>',
                'list' => !empty($arr) ? self::mergeListMenuArray($arr, $_params) : [],
                'menu' => !empty($arr) ? self::multiMenu($arr, null, null) : [],
                'footer' => $arrFooter,
                'support' => $arrSupport,
                'service' => $arrService,
            ];
        } else {
            return !empty($arr) ? self::mergeListMenu($arr, $_params) : '<option value="">' . (__('admins::layer.search.form.category')) . '</option>';
        }
    }

    public function mergeListMenu($_data, $_params, $parent_id = null, $trees = null, $i = 0, $str = '')
    {
        //params
        $active_id = !empty($_params['parent_id']) ? $_params['parent_id'] : [];

        //parent
        if (!empty($_data['parent'])) {
            $trees .= '<option value="">' . (__('admins::layer.search.form.category')) . '</option>';
            foreach ($_data['parent'] as $row) {
                $trees .= '<option value="' . $row['id'] . '" ' . (in_array($row['id'], $active_id) ? 'selected' : '') . '>' . $row['title'] . '</option>';
                if (!empty($_data['list'][$row['id']])) $trees = self::mergeListMenu($_data['list'], $_params, $row['id'], $trees, 1, '--');
            }
        } else {
            $tmp = '';
            for ($j = 0; $j < $i; $j++) $tmp .= $str;
            foreach ($_data[$parent_id] as $row) {
                $trees .= '<option value="' . $row['id'] . '" ' . (in_array($row['id'], $active_id) ? 'selected' : '') . '>' . $tmp . ' ' . $row['title'] . '</option>';
                if (!empty($_data[$row['id']])) $trees = self::mergeListMenu($_data, $_params, $row['id'], $trees, $i + 1, '--');
            }
        }
        return $trees;

    }

    public function mergeListMenuArray($_data, $_params, $parent_id = null, $trees = null, $i = 0, $str = '')
    {
        //parent
        if (!empty($_data['parent'])) {
            foreach ($_data['parent'] as $row) {
                $trees[$row['id']] = $row['title'];
                if (!empty($_data['list'][$row['id']])) $trees = self::mergeListMenuArray($_data['list'], $_params, $row['id'], $trees, 1, '--');
            }
        } else {
            $tmp = '';
            for ($j = 0; $j < $i; $j++) $tmp .= $str;
            foreach ($_data[$parent_id] as $row) {
                $trees[$row['id']] = $tmp . ' ' . $row['title'];
                if (!empty($_data[$row['id']])) $trees = self::mergeListMenuArray($_data, $_params, $row['id'], $trees, $i + 1, '--');
            }
        }
        return $trees;

    }

    public function multiMenu($_data, $parentid = null, $trees = NULL)
    {
        if (empty($parentid)) {
            $parmenu = !empty($_data['parent']) ? $_data['parent'] : [];
        } else {
            $parmenu = !empty($_data['list'][$parentid]) ? $_data['list'][$parentid] : [];
        }

        if (count($parmenu) > 0) {
            $trees .= '<ul>';
            foreach ($parmenu as $field) {
                if ($parentid != null) {
                    if ($field['type'] == 'link'){
                        $trees .= '<li><a href="' . $field['url'] . '" target="_blank" title="' . $field['title'] . '">' . $field['title'] . '</a>';
                    }else {
                        $trees .= '<li><a href="' . asset($field['slug']) . '" title="' . $field['title'] . '">' . $field['title'] . '</a>';
                    }
                    $trees = $this->multiMenu($_data, $field['id'], $trees);
                    $trees .= '</li>';
                } else {
                    if ($field['id'] == 1) {
                        $trees .= '<li><a href="' . route('client.home') . '" title="' . $field['title'] . '">' . $field['title'] . '</a>';
                    } elseif ($field['type'] == 'link') {
                        $trees .= '<li><a href="' . $field['url'] . '" target="_blank" title="' . $field['title'] . '">' . $field['title'] . '</a>';
                    } else {
                        $trees .= '<li><a href="' . asset($field['slug']) . '" title="' . $field['title'] . '">' . $field['title'] . '</a>';
                    }
                    $trees = $this->multiMenu($_data, $field['id'], $trees);
                    $trees .= '</li>';
                }
            }
            $trees .= '</ul>';
        }
        return $trees;
    }

    public function multiCate($_parentid = null, $_trees = NULL)
    {
        $parmenu = self::findListParentId($_parentid);
        $_trees[$_parentid] = $_parentid;
        if (count($parmenu) > 0) {
            foreach ($parmenu as $field) {
                $_trees[$field->id] = $field->id;
                $_trees = $this->multiCate($field->id, $_trees);
            }
        }
        return $_trees;
    }

    public function findListParentId($_id)
    {
        return $this->repository->findListParentId($_id);
    }

}
