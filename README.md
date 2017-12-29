<h1>Learning Symfony 3.4</h1>

1) `composer install`
2)  configure database
3) `bower update`
4) `bin/console assetic:dump`
5)  <p>Registration admin:</p>

    `php bin/console fos:user:create`
    <ul>
    <li> Please choose a username:admin</li>
    <li> Please choose an email:admin@example.com</li>
    <li> Please choose a password:admin</li>
    <li> Created user admin </li>
    </ul>
6) add role -  `php bin/console fos:user:promote username ROLE_ADMIN`

# TODO:
<ul>
    <li>bower install components-font-awesome --save</li>
    <li>cd web/assets/bower/; ln -sf components-font-awesome font-awesome</li>
    <li>php bin/console doctrine:database:create; php bin/console doctrine:schema:update</li>  
<ul> 