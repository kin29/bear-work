<?php
namespace MyVendor\WellSaid\Resource\App;

use BEAR\Resource\ResourceObject;
use Ray\CakeDbModule\DatabaseInject;

class Said extends ResourceObject
{
    use DatabaseInject;

    public function onGet(string $mode, int $id = null, string $said = null, string $who = null) : ResourceObject
    {
        switch ($mode) {
            //新規登録
            case 'insert':
                $this
                    ->db
                    ->insert(
                        'said_table',
                        ['said' => $said, 'who' => $who, 'create_date' => new \DateTime('now'), 'del_flg' => 0],
                        array('create_date' => 'datetime')
                    );
                // created
                $this->code = 201;
                $this->body = "insert[$said]";
                break;

            //削除
            case 'delete':
                $this
                    ->db
                    ->update(
                        'said_table',
                        ['del_flg' => 1],
                        ['id' => $id]
                    );
                // no content
                $this->code = 204;
                $this->body = "delete!(id=$id)";
                break;

            //一覧取得
            case "show":
                $this->body = $this
                    ->db
                    ->newQuery()
                    ->select('id, said, who, create_date')
                    ->from('said_table')
                    ->where('del_flg = 0')
                    ->execute()
                    ->fetchAll('assoc');
                break;

            //ランダムな名言を取得
            case 'random':
                $this->body = $this
                    ->db
                    ->newQuery()
                    ->select('id, said, who')
                    ->from('said_table')
                    ->where('del_flg = 0')
                    ->order('RANDOM()')
                    ->execute()
                    ->fetch('assoc');

                break;
            default;
                $this->body = "not found mode[mode=$mode]";
        }
        return $this;
    }

}