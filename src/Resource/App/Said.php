<?php
namespace MyVendor\WellSaid\Resource\App;

use BEAR\Resource\ResourceObject;
use Ray\CakeDbModule\DatabaseInject;

class Said extends ResourceObject
{
    use DatabaseInject;

    public function onGet(string $mode, int $id = null, string $said = null, string $who = null) : ResourceObject
    {
        switch($mode){
            //新規登録
            case 'insert':
                $this->body = 'insertしました';
                $this
                    ->db
                    ->insert(
                        'said_table',
                         ['said' => $said, 'who' => $who, 'create_date' => new \DateTime('now'), 'del_flg' => 0],
                         array('create_date' => 'datetime')
                    );
                // created
                $this->code = 201;

                break;

            //削除
            case 'delete':
                $this->body = 'deleteしました';
                 $this
                    ->db
                    ->update(
                  'said_table',
                        ['del_flg' => 1],
                        ['id' => $id]
                    );
                // no content
                $this->code = 204;
                break;

            //一覧取得
            case "show":
                $this->body = $this
                    ->db
                    ->newQuery()
                    ->select('*')
                    ->from('said_table')
                    ->where('del_flg = 0')
                    ->execute()
                    ->fetch('assoc');

                break;

            //ランダムな名言を取得
            case 'random':
            $this->body = $this
                    ->db
                    ->newQuery()
                    ->select('*')
                    ->from('said_table')
                    ->where('del_flg = 0')
                    ->order('RANDOM()')
                    ->execute()
                    ->fetch('assoc');

                break;

        }
        return $this;
    }

}