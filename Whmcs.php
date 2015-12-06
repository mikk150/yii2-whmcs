<?php
namespace mikk150\whmcs;

use Amenophis\WHMCS\Adapter\Json\Connector;
use yii\base\Component;

/**
*
*/
class Whmcs extends Component
{
    public $host;
    public $username;
    public $password;

    private $_connection;

    public function getConnection()
    {
        if (!$this->_connection) {
            $this->_connection=Connector::getInstance($this->host, $this->username, md5($this->password));
        }
        return $this->_connection;
    }

    public function execute($action, $params = array())
    {
        return $this->getConnection()->execute($action, $params);
    }

    public function __call($name, $params = array())
    {
        if (!isset($params[0])) {
            return $this->execute($name);
        }
        return $this->execute($name, $params[0]);
    }
}
