<?php

abstract class Me2Attachment {
    var $type = null;
}

final class Me2Image extends Me2Attachment {
    const MaxSize = 10485760;

    var $name;
    var $mime = 'image/jpeg';

    static function fromFile($path, $name = null) {
        if (is_null($name)) $name = basename($path);
        $info = getimagesize($path);

        switch ($info['mime']) {
            case 'image/jpeg':
                return new self(join('', file($path)), $name);

            case 'image/png': $gd = 'imagecreatefrompng'; break;
            case 'image/gif': $gd = 'imagecreatefromgif'; break;

            default: throw new UnexpectedValueException(
                "JPEG, PNG, GIF 형식의 파일만 지원합니다."
            );
        }
        return self::fromGD($gd($path), $name);
    }

    static function fromFilePointer($fp, $name = null) {
        $binary = '';
        do {
            $binary .= fgets($fp);
        } while (!feof($fp));

        return self::fromGD(imagecreatefromstring($binary));
    }

    static function fromURL($url, $name = null) {
        throw new Exception('Me2Image::fromURL is not implemented yet!');
    }

    static function fromGD($image, $name = null) {
        ob_start();
        imagejpeg($image, null, 100);
        return new self(ob_get_clean(), $name);
    }

    function __construct($binary, $name = null) {
        if (strlen($binary) > self::MaxSize) {
            throw new UnexpectedValueException(
                self::MaxSize . "Bytes 이하의 파일만 지원합니다."
            );
        }

        if (is_null($name)) $name = md5(rand()).'.jpg';

        $this->binary = $binary;
        $this->name = $name;
    }

    function __toString() {
        return (string) $this->binary;
    }
}

class Me2Callback extends Me2Attachment {
    const Document = 'document';
    const Photo = 'photo';
    const Video = 'video';
    const Audio = 'audio';
    const Friend = 'friend';
    const Code='code';

    function __construct($url, $icon, $type = self::Document) {
        $this->url = $url;
        $this->icon = $icon;
        $this->type = $type;
    }

    function __toString() {
        return $this->url;
    }
}

class Me2FlickrPhoto extends Me2Callback {
    const DefaultType = 'me2photo';
    const UrlForm = 'http://me2day.net/front/me2photo?id=%s';

    const Host = 'api.flickr.com';
    const Port = 80;

    static $apiKey = null;
    protected static $socket = null;

    function __construct($photo_id, $type = self::DefaultType) {
        $this->photo_id = $photo_id;
        $url = sprintf(self::UrlForm, $photo_id);
        parent::__construct($url, null, $type);
        unset($this->icon);
    }

    function getSquare() {
        $method = 'flickr.photos.getSizes';
        $params = array('photo_id' => $this->photo_id);
        $response = self::call($method, $params);
        return $response['sizes']['size'][0]['source'];
    }

    function __get($property) {
        if ($property == 'icon') return $this->getSquare();
    }

    static function fromPermerlink($url) {
        $info = self::parsePermerlink($url);
        return new self($info['photo_id']);
    }

    static function fromPhotoUrl($url) {
        $info = self::parsePhotoUrl($url);
        return new self($info['photo_id']);
    }

    static function parsePermerlink($url) {
        preg_match(
            '{
                ^http://(?:www\.)?
                flickr\.com/photos/
                (?P<user_id> [^/]+)
                /
                (?P<photo_id> \d+)
            }x',
            $url, $matches
        );
        return array_intersect_key($matches, array_flip(
            array('user_id', 'photo_id')
        ));
    }

    static function parsePhotoUrl($url) {
        preg_match(
            '{
                ^http://farm
                (?P<farm_id> [^.]+)
                \.static\.flickr\.com/
                (?P<server_id> [^/]+)
                /
                (?P<photo_id> \d+)
            }x',
            $url, $matches
        );
        return array_intersect_key($matches, array_flip(
            array('farm_id', 'server_id', 'photo_id')
        ));
    }

    protected static function openSocket() {
        while (!self::$socket) {
            self::$socket = fsockopen(self::Host, self::Port);
        }
    }

    protected static function call($method, $params) {
        if (!self::$apiKey) {
            throw new FlickrException(
                'Missing flickr api key'
            );
        }
        self::openSocket();
        $crlf = "\r\n";
        $header = array(
            'Host' => self::Host,
            'Accept' => 'application/json',
            'Connection' => 'Keep-Alive'
        );
        $params['api_key'] = self::$apiKey;
        $params['method'] = $method;
        $params['format'] = 'json';
        $params['nojsoncallback'] = 1;

        $query = '';
        foreach ($params as $key => $value) {
            $query .= "{$key}={$value}&";
        }
        $query = substr($query, 0, -1);

        $request = "GET /services/rest/?{$query}{$crlf}";
        foreach ($header as $key => $value) {
            $request .= "{$key}: {$value}{$crlf}";
        }

        fwrite(self::$socket, $request);
        $response = json_decode(rtrim(fgets(self::$socket)), true);
        if ($response['code']) {
            throw new FlickrException($response['message']);
        }
        return $response;
    }
}

class FlickrException extends RuntimeException {}

