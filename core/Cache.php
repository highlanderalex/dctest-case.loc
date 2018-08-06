<?php

namespace framework;

class Cache
{
    use TSingleton;

    public function set($key, $data, $second = 3600)
    {
        if($second)
		{
            $content['data'] = $data;
            $content['end_time'] = time() + $second;
            if(file_put_contents(CACHE . "/" . md5($key) . "txt", serialize($content)))
			{
                return true;
            }
        }
        return false;
    }

    public function get($key)
    {
        $file = CACHE . "/" . md5($key) . "txt";
        if(file_exists($file))
		{
            $content = unserialize(file_get_contents($file));
            if(time() <= $content['end_time'])
			{
                return $content['data'];
            }
            unlink($file);
        }
        return false;
    }

    public function delete($key)
    {
        $file = CACHE . "/" . md5($key) . "txt";
        if(file_exists($file))
		{
            unlink($file);
        }
    }
}