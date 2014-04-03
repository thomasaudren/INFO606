<?php

if(isset($_POST['login']) && isset($_POST['pass']))
{
	echo 'OK';
}
else
{
	echo '!OK';
}