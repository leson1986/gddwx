<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/06
 * Author: Akon
 * Remark: 图片缩略图及水印增加类
 ***********************************************************/
 

  class GDImage{

    var $info;
    var $backup;

    Function GDImage($origFilename=false){
        if($origFilename)
            $this->loadFile($origFilename);
    }

    /**
     * 载入图片文件
     * @param    string      $origFilename   文件名及路径
     * @return   boolean     载入图片文件是否成功
     */
    Function loadFile($origFilename){

        if(!file_exists($origFilename)) return false;
        $this->info['origFilename'] = $origFilename;
        $this->info['origSize']     = @getimagesize($origFilename);
        switch($this->info['origSize'][2]){
            case 1  /*gif*/ : $this->info['im'] = imagecreatefromgif ($origFilename); break;
            case 2  /*jpg*/ : $this->info['im'] = imagecreatefromjpeg($origFilename); break;
            case 3  /*png*/ : $this->info['im'] = imagecreatefrompng ($origFilename); break;
            case 6  /*bmp*/ : $this->info['im'] = imagecreatefrombmp ($origFilename); break;
            case 15 /*wbmp*/: $this->info['im'] = imagecreatefromwbmp($origFilename); break;
            default:
            return false;
        }
		$this->backup = false;
        return true;
    }

    /**
     * 生成图片缩略图
     * @param    integer      $maxW              最大宽度
     * @param    integer      $maxH              最大高度
     * @param    boolean      $constraint        是否约束图片比例
     */
     Function mkThumb($maxW, $maxH=false, $constraint=true){
        $origSize = &$this->info['origSize'];
        $im       = &$this->info['im'];
        $resizeByH =
        $resizeByW = false;

        if ($origSize[0] > $maxW && $maxW) $resizeByW = true;
        if ($origSize[1] > $maxH && $maxH) $resizeByH = true;
        if ($resizeByH && $resizeByW){
            $resizeByH = ($origSize[0]/$maxW<$origSize[1]/$maxH);
            $resizeByW = !$resizeByH;
        }
        if ($resizeByW){
            if($constraint){
                $newW = $maxW;
                $newH = ($origSize[1]*$maxW)/$origSize[0];
            }
            else{
                $newW = $maxW;
                $newH = $origSize[1];
            }
        }
        elseif($resizeByH){
            if($constraint){
                $newW = ($origSize[0]*$maxH)/$origSize[1];
                $newH = $maxH;
            }
            else{
                $newW = $origSize[0];
                $newH = $maxH;
            }
        }
        else{
            $newW = $origSize[0];
            $newH = $origSize[1];
        }
        if($newW != $origSize[0] || $newH != $origSize[1]){
            $imN = imagecreatetruecolor($newW, $newH);
            imagecopyresampled($imN, $im, 0, 0, 0, 0, $newW, $newH, $origSize[0], $origSize[1]);
            imagedestroy($im);
            $this->info['im'] = $imN;
        }
        $this->info['origSize'][0] = $newW;
        $this->info['origSize'][1] = $newH;
    }

    /**
     * 按指定区域大小截取图片
     * @param    integer      $startX         开始 X轴 坐标
     * @param    integer      $startY         开始 Y轴 坐标
     * @param    integer      $endX           结束 X轴 坐标
     * @param    integer      $endY           结束 Y轴 坐标
     */
    Function crop($startX, $startY, $endX=false, $endY=false){
        $im       = &$this->info['im'];
        $origSize = &$this->info['origSize'];
        if ($endX == false)
            $endX = $origSize[0]-$startX;
        if ($endY == false)
            $endY = $origSize[1]-$startY;
        $width  = $endX-$startX;
        $height = $endY-$startY;
        $imN = imagecreatetruecolor($width, $height);
        imagecopy($imN, $im, 0, 0, $startX, $startY, $width, $height);
        imagedestroy($im);
        $this->info['im'] = $imN;
        $this->info['origSize'][0] = $width;
        $this->info['origSize'][1] = $height;
    }

    /**
     * 按指定尺寸截取图片，以中心为起点
     * @param    integer      $width     图片宽度
     * @param    integer      $height    图片高度
     * @param    integer      $moveX     X轴 坐标偏移像素
     * @param    integer      $moveY     Y轴 坐标偏移像素
     */
    Function cropCenter($width, $height, $moveX=0, $moveY=0){
        $origSize = &$this->info['origSize'];
        $centerX  = $origSize[0]/2;
        $centerY  = $origSize[1]/2;
        $topX = $centerX-$width/2;
        $topY = $centerY-$height/2;
        $endX = $centerX+$width/2;
        $endY = $centerY+$height/2;
        return $this->crop($topX+$moveX, $topY+$moveY, $endX+$moveX, $endY+$moveY);
    }

     /**
     * 创建图片备份
     */
    Function createBackup(){
        if($this->backup)
            imagedestroy($this->backup['im']);
        $this->backup = $this->info;
        $this->backup['im'] = imagecreatetruecolor($this->info['origSize'][0], $this->info['origSize'][1]);
        imagecopy($this->backup['im'], $this->info['im'], 0, 0, 0, 0, $this->info['origSize'][0], $this->info['origSize'][1]);
    }

     /**
     * 从备份中恢复图片
     */
    Function restoreBackup(){
        imagedestroy($this->info['im']);
        $this->info = $this->backup;
        $this->info['im'] = imagecreatetruecolor($this->info['origSize'][0], $this->info['origSize'][1]);
        imagecopy($this->info['im'], $this->backup['im'], 0, 0, 0, 0, $this->info['origSize'][0], $this->info['origSize'][1]);
    }

     /**
     * 创建图片文件
     * @param    string      $output_filename    图片文件名
     * @param    string      $output_as          图片文件格式 (gig,wbmp,默认为jpeg格式)
     * @param    string      $quality            图片质量(0-100)
     */
    Function build($output_filename=false, $output_as=false, $quality=80){
        $origSize = &$this->info['origSize'];
        $im       = &$this->info['im'];

        if($output_filename===false){
            // Output filename wasn't found, let's overwrite original file.
            $output_filename = $this->info['origFilename'];
        }

        // Try to auto-determine output format
        if(!$output_as)
            $output_as = ereg_replace(".*\.(.+)", "\\1", $output_filename);

        if    ($output_as == 'gif')  return imagegif ($im, $output_filename);
        elseif($output_as == 'png')  return imagepng ($im, $output_filename);
        elseif($output_as == 'wbmp') return imagewbmp($im, $output_filename);
        else /* default: jpeg     */ return imagejpeg($im, $output_filename, $quality);
    }
}

if(!function_exists('imagecreatefrombmp')){
    function imagecreatefrombmp($filename){
        if(!($f1 = fopen($filename, "rb")))
            return false;
        $FILE = unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread($f1,14));
        if($FILE['file_type'] != 19778)
            return false;
        $BMP = unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel'.
        '/Vcompression/Vsize_bitmap/Vhoriz_resolution'.
        '/Vvert_resolution/Vcolors_used/Vcolors_important', fread($f1,40));
        $BMP['colors'] = pow(2,$BMP['bits_per_pixel']);
        if($BMP['size_bitmap'] == 0)
            $BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];
        $BMP['bytes_per_pixel'] = $BMP['bits_per_pixel']/8;
        $BMP['bytes_per_pixel2'] = ceil($BMP['bytes_per_pixel']);
        $BMP['decal'] = ($BMP['width']*$BMP['bytes_per_pixel']/4);
        $BMP['decal'] -= floor($BMP['width']*$BMP['bytes_per_pixel']/4);
        $BMP['decal'] = 4-(4*$BMP['decal']);
        if ($BMP['decal'] == 4)
            $BMP['decal'] = 0;
        $PALETTE = array();
        if ($BMP['colors'] < 16777216)
            $PALETTE = unpack('V'.$BMP['colors'], fread($f1,$BMP['colors']*4));
        $IMG = fread($f1,$BMP['size_bitmap']);
        $VIDE = chr(0);
        $res = imagecreatetruecolor($BMP['width'],$BMP['height']);
        $P = 0;
        $Y = $BMP['height']-1;
        while ($Y >= 0){
            $X=0;
            while ($X < $BMP['width']){
                if ($BMP['bits_per_pixel'] == 24)
                    $COLOR = unpack("V",substr($IMG,$P,3).$VIDE);
                elseif ($BMP['bits_per_pixel'] == 16){
                    $COLOR = unpack("n",substr($IMG,$P,2));
                    $COLOR[1] = $PALETTE[$COLOR[1]+1];
                }
                elseif ($BMP['bits_per_pixel'] == 8){
                    $COLOR = unpack("n",$VIDE.substr($IMG,$P,1));
                    $COLOR[1] = $PALETTE[$COLOR[1]+1];
                }
                elseif ($BMP['bits_per_pixel'] == 4){
                    $COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));
                    if (($P*2)%2 == 0)
                        $COLOR[1] = ($COLOR[1] >> 4) ; else $COLOR[1] = ($COLOR[1] & 0x0F);
                    $COLOR[1] = $PALETTE[$COLOR[1]+1];
                }
                elseif ($BMP['bits_per_pixel'] == 1){
                    $COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));
                        if (($P*8)%8 == 0) $COLOR[1] =  $COLOR[1]        >>7;
                    elseif (($P*8)%8 == 1) $COLOR[1] = ($COLOR[1] & 0x40)>>6;
                    elseif (($P*8)%8 == 2) $COLOR[1] = ($COLOR[1] & 0x20)>>5;
                    elseif (($P*8)%8 == 3) $COLOR[1] = ($COLOR[1] & 0x10)>>4;
                    elseif (($P*8)%8 == 4) $COLOR[1] = ($COLOR[1] & 0x8 )>>3;
                    elseif (($P*8)%8 == 5) $COLOR[1] = ($COLOR[1] & 0x4 )>>2;
                    elseif (($P*8)%8 == 6) $COLOR[1] = ($COLOR[1] & 0x2 )>>1;
                    elseif (($P*8)%8 == 7) $COLOR[1] = ($COLOR[1] & 0x1 );
                    $COLOR[1] = $PALETTE[$COLOR[1]+1];
                }
                else
                    return false;
                imagesetpixel($res,$X,$Y,$COLOR[1]);
                $X++;
                $P += $BMP['bytes_per_pixel'];
            }
            $Y--;
            $P+=$BMP['decal'];
        }
        fclose($f1);
        return $res;
    }
}
?>