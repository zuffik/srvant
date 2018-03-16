<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 31.1.2018
 * Time: 10:54
 */

namespace Zuffik\Srvant\System\Files;


class Directory extends FileInfo
{
    /**
     * @inheritDoc
     */
    public function exists()
    {
        return parent::exists() && is_dir((string)$this->path);
    }
}