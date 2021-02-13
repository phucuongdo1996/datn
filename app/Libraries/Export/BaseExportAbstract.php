<?php

namespace App\Libraries\Export;

abstract class BaseExportAbstract
{
    /**
     * Variable file name
     *
     * @var string $fileName file name csv
     */
    protected $fileName;

    /**
     * Variable extension
     *
     * @var string $extension file extension
     */
    protected $extension;

    /**
     * BaseExportAbstract constructor.
     */
    public function __construct()
    {
        $this->setName();
        $this->setExtension();
    }

    /**
     * Set file name
     *
     * @return mixed
     */
    abstract protected function setName();

    /**
     * Set extension file
     *
     * @return mixed
     */
    abstract protected function setExtension();

    /**
     * Get file name full
     *
     * @return mixed
     */
    public function getFileName()
    {
        return formatFileName($this->fileName . $this->extension);
    }
}
