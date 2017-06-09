<?php


namespace Polidog\Blog\Resource\App;


use BEAR\Resource\ResourceObject;
use Koriym\HttpConstants\ResponseHeader;
use Koriym\HttpConstants\StatusCode;
use Koriym\QueryLocator\QueryLocatorInject;
use Ramsey\Uuid\Uuid;
use Ray\AuraSqlModule\AuraSqlInject;

class User extends ResourceObject
{
    use AuraSqlInject;
    use QueryLocatorInject;

    public function onGet(string $id) : ResourceObject
    {
        $user = $this->pdo->fetchOne($this->query['user_select'],['id' => $id]);
        if (empty($user)) {
            $this->code = StatusCode::NOT_FOUND;
            return $this;
        }
        $this['user'] = $user;
        return $this;
    }

    public function onPost(string $email, string $password) : ResourceObject
    {
        $id = Uuid::uuid4()->toString();

        $this->pdo->perform($this->query['user_insert'],[
            'id' => $id,
            'email' => $email,
            'password' => hash('sha256',$password.$_ENV['salt']), // TODO パスワードのハッシュをどうするか・・・
        ]);
        $this->code = StatusCode::CREATED;
        $this->headers[ResponseHeader::LOCATION] = "/todo?id={$id}";

        return $this;
    }

}
