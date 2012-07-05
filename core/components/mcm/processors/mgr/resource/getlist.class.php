<?php
class MCMResourceGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'modResource';
    public $objectType = 'resource';
    public $defaultSortField = 'pagetitle';
    public $defaultSortDirection = 'ASC';
    public $checkListPermission = true;

/*    public function prepareQueryBeforeCount(xPDOQuery $c) {

        $c->leftJoin('modTemplate','Template');
        $search = $this->getProperty('search');
        if (!empty($search)) {
            $c->where(array(
                'pagetitle:LIKE' => '%'.$search.'%',
                'OR:description:LIKE' => '%'.$search.'%',
                'OR:content:LIKE' => '%'.$search.'%',
                'OR:id:LIKE' => '%'.$search.'%',
            ));
        }
        $template = $this->getProperty('template');
        if (!empty($template)) {
            $c->where(array(
                'template' => $template,
            ));
        }
        return $c;
    }

    public function prepareQueryAfterCount(xPDOQuery $c) {
        $c->select(array('modResource.*','Template.templatename'));
        return $c;
    }
*/
    public function prepareRow(xPDOObject $object) {
        $objectArray = $object->toArray();
        $objectArray['hidemenu'] = (boolean)$objectArray['hidemenu'];
        unset($objectArray['content']);
        return $objectArray;
    }
}
return 'MCMResourceGetListProcessor';
