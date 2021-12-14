<?php

require_once('core/CoreLoader.php');
require_once('core/RequestHandler.php');

CoreLoader::setFileExt('.php');
spl_autoload_register('CoreLoader::loader');

RequestHandler::tratyRequest();


