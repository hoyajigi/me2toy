<?
require_once '../Me2.php';
Me2Api::$applicationKey = '507402bcdd47b41faf565a2b1cb163cf';
$user = new Me2AuthenticatedUser('hoyajigi', "51069392");
assert($user instanceof Me2AuthenticatedUser);

$callback=new Me2Callback("http://me2toy.net/test/testofcallbackpage.php","http://www.classes.cs.uchicago.edu/archive/2005/summer/15200-1/cplusplus.jpg",Me2Callback::Code);

$post = $user->post(
        'python에서 이 소스를 실행 하면 무중력 상태가 된다던데...',
        'me2code',
        1,$callback
    );
?>