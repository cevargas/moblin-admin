<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
    Doctrine\DBAL\Logging\EchoSQLLogger;

class Doctrine {

  public $em = null;

  public function __construct()
  {
    // load database configuration from CodeIgniter
    require APPPATH.'config/database.php';
      
    // Set up class loading. You could use different autoloaders, provided by your favorite framework,
    // if you want to.
    require_once APPPATH.'libraries/Doctrine/Common/lib/Doctrine/Common/ClassLoader.php';

    // load the Doctrine classes
    $doctrineClassLoader = new \Doctrine\Common\ClassLoader('Doctrine', APPPATH.'libraries');
    $doctrineClassLoader->register();

    // load Symfony2 helpers
    // Don't be alarmed, this is necessary for YAML mapping files
    $symfonyClassLoader = new \Doctrine\Common\ClassLoader('Symfony', APPPATH.'libraries/Doctrine');
    $symfonyClassLoader->register();

    // load the entities
    $entityClassLoader = new \Doctrine\Common\ClassLoader('Entities', APPPATH.'models');
    $entityClassLoader->register();

    // load the proxy entities
    $proxyClassLoader = new \Doctrine\Common\ClassLoader('Proxies', APPPATH.'models');
    $proxyClassLoader->register();

    // Set up caches
    $config = new Configuration;
    $cache = new ArrayCache;
    $config->setMetadataCacheImpl($cache);
      
    // set up annotation driver
    $yamlDriver = new \Doctrine\ORM\Mapping\Driver\YamlDriver(APPPATH.'models/generated');
    $config->setMetadataDriverImpl($yamlDriver);
    $config->setQueryCacheImpl($cache);

    // Proxy configuration
    $config->setProxyDir(APPPATH.'/models/proxies');
    $config->setProxyNamespace('Proxies');

    // Set up logger
    //$logger = new EchoSQLLogger;
    //$config->setSQLLogger($logger);

    $config->setAutoGenerateProxyClasses( TRUE );
	
	if (strpos($db['default']['dbdriver'], 'pdo') === false) {
		$pdo = 'pdo_';
	}

	if($db['default']['dbdriver'] == 'mysqli') 
		$pdo = '';   
	
	if($db['default']['dbdriver'] == 'postgre') 
        $db['default']['dbdriver'] = 'pgsql';
		
    // Database connection information      	
    $connectionOptions = array(
        'driver'    => $pdo.$db['default']['dbdriver'],
        'user'      => $db['default']['username'],
        'password'  => $db['default']['password'],
        'host'      => $db['default']['hostname'],
        'dbname'    => $db['default']['database']
    );
      
    // Create EntityManager
    $this->em = EntityManager::create($connectionOptions, $config);
      
  }
}