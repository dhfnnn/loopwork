<?php

namespace Loopwork\Installer;
use Loopwork\Installer\Installer;
class Setup
{
public static function setup(){
 
echo "\033[" . 35 . "m" . "
 __      _____   _____   _____   __      __  _____   _____   __  __     
/\ \    /\  __`\/\  __`\/\  _ `\/\ \  __/\ \/\  __`\/\  _ `\/\ \/\ \    
\ \ \   \ \ \/\ \ \ \/\ \ \ \L\ \ \ \/\ \ \ \ \ \/\ \ \ \L\ \ \ \/'/'   
 \ \ \  _\ \ \ \ \ \ \ \ \ \ ,__/\ \ \ \ \ \ \ \ \ \ \ \ ,  /\ \ , < _   
  \ \ \L\ \ \ \_\ \ \ \_\ \ \ \/  \ \ \_/ \_\ \ \ \_\ \ \ \ \ \ \ \ \ \  
   \ \____/\ \_____\ \_____\ \_\   \ \________/\ \_____\ \_\ \_\ \_\ \_\
    \/___/  \/_____/\/_____/\/_/    \/_______/  \/_____/\/_/\/ /\/_/\/_/    
" . "\033[0m";

echo "\033[" . 33 . "m" . "

                        Simplified Library
Suitable for those of you who are learning or want to try simple routing
                             VERSION 1  

                             
" . "\033[0m";

        $setupFolder = readline("Project Names: ");
echo "
";
        exec("mkdir $setupFolder");
        $newfol = getcwd()."/$setupFolder";
        Installer::run($newfol);
    }
}