<?php

function getGit($dir)
{

  if($gitConfig = file_get_contents($dir."/.git/config", "r")) {
    
    $gitRepo = Array();
    $start = "url = ";
    $end = ".git";
    $remoteUrl = explode ( $start , $gitConfig);
    $remoteUrl = explode ( $end , $remoteUrl[1]);
    $removeGitHost = "https://github.com/";
    $removeGroup = "/";
    $repoName = explode ( $removeGitHost , $remoteUrl[0]);
    //$repoName = explode ( $removeGroup , $repoName[1]);

    $gitRepo['url'] = $remoteUrl[0].".git";
    $gitRepo['name'] = $repoName[1];

  }
  

  return $gitRepo;

}

function dirsize($dir)
{
  @$dh = opendir($dir);
  $size = 0;
  while ($file = @readdir($dh))
  {
    if ($file != "." and $file != "..") 
    {
      $path = $dir."/".$file;
      if (is_dir($path))
      {
        $size += dirsize($path); // recursive in sub-folders
      }
      elseif (is_file($path))
      {
        $size += filesize($path); // add file
      }
    }
  }
  @closedir($dh);
  return round(($size/1000), 2)." mb";
}


?>