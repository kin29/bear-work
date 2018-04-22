<?php
namespace MyVendor\WellSaid\Resource\App;

use BEAR\Resource\ResourceObject;
use Ray\CakeDbModule\DatabaseInject;

class Said extends ResourceObject
{
    use DatabaseInject;

    /**
     * @param string $mode
     * @return ResourceObject
     */
    public function onGet(string $mode): ResourceObject
    {
        switch ($mode) {
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

    /**
     * @param string $said
     * @param string $who
     * @return ResourceObject
     */
    public function onPost(string $said, string $who = "unknown"): ResourceObject
    {
        $data = array();
        $data['said'] = $said;
        $data['who'] = $who;
        $data['create_date'] = new \DateTime('now', new \DateTimeZone('Asia/Tokyo'));
        $data['del_flg'] = 0;
        $this->db->insert('said_table', $data, array('create_date' => 'datetime'));

        // created
        $this->code = 201;
        $this->body = "insert[$said]";
        // hyperlink
        $this->headers['Location'] = '/said?said=' . $said;

        return $this;
    }

    /**
     * @param int $id
     * @return ResourceObject
     */
    public function onPut(int $id): ResourceObject
    {
        $this
            ->db
            ->update(
                'said_table',
                ['del_flg' => 1],
                ['id' => $id]
            );

        // no content
        $this->code = 204;
        $this->body = "delete![id:$id]";

        return $this;
    }
}