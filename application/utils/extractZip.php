<?php
	function unzip($file, $dest)
	{
		$zip = new ZipArchive();
		if ($zip->open($file) !== true) 
		{
			return 'Impossible d\'ouvrir l\'archive';
		}

		$zip->extractTo($dest);
	    $zip->close();
	    unlink($file);
	    echo 'Archive extraite';
	}