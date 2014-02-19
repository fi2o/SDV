<?
/*
EasyThumbnail - vers�o 0.1 - Por Rog�rio Bragil  - Esta classe
cria um thumbnail de uma imagem atrav�s de um c�lculo de aproxima��o. Voc�
pode criar miniaturas de imagens de diferentes tamanhos que o resultado ser�
uma cole��o de thumbnails de dimens�es parecidas. Ideal para albuns de fotos,
onde basta voc� fazer o upload da imagem e deixar a classe gerar o thumbnail.
OBS: trabalha com jpg e png somente. 

  e-mail: bragil@webdevel.com.br - Qualquer sugest�o, d�vida ou cr�tica ser�o bem aceitos!
*/
class EasyThumbnail
{
    private $debug= true;
    private $errflag= false;
    private $ext;
    private $origem;
    private $destino;
    private $errormsg;
    
    function __construct($imagem, $destino, $aprox)
    {
        // se o arquivo n�o existir, erro
        if (!file_exists($imagem))
        {
            $this->errormsg= "Arquivo n�o encontrado.";
            return false;
        }
        else
        {
            $this->origem= $imagem;
            $this->destino= $destino;
        }
        // obt�m a extens�o do arquivo
        if (!$this->ext= $this->getExtension($imagem))
        {
            $this->errormsg= "Tipo de arquivo inv�lido.";
            return false;
        }
        // gera a imagem do thumbnail com o caminho e nome do arquivo especificados
        $this->createThumbImg($aprox);
    }
    
    // retorna as dimens�es (x,y) do thumbnail a ser gerado
    public function getThumbXY($x, $y, $aprox)
    {
         if ($x >= $y)
        {
            if ($x > $aprox)
            {
                $x1= (int)($x * ($aprox/$x));
                $y1= (int)($y * ($aprox/$x));
            }
            else
            {
                $x1= $x;
                $y1= $y;
            }
        }
        else
        {
            if ($y > $aprox)
            {
                $x1= (int)($x * ($aprox/$y));
                $y1= (int)($y * ($aprox/$y));
            }
            // Caso a imagem seja menor do que
            // deve ser aproximado, mant�m tamanho original para o thumb.
            else
            {
                $x1= $x;
                $y1= $y;
            }
        }
        $vet= array("x" => $x1, "y" => $y1);
        return $vet;
    }
    
    // cria a imagem do thumbnail
    private function createThumbImg($aprox)
    {
        // imagem de origem
        $img_origem= $this->createImg();

        // obt�m as dimens�es da imagem original
        $origem_x= ImagesX($img_origem);
        $origem_y= ImagesY($img_origem);
        
        // obt�m as dimens�es do thumbnail
        $vetor= $this->getThumbXY($origem_x, $origem_y, $aprox);
        $x= $vetor['x'];
        $y= $vetor['y'];
        
        // cria a imagem do thumbnail
        $img_final = ImageCreateTrueColor($x, $y);
        ImageCopyResampled($img_final, $img_origem, 0, 0, 0, 0, $x+1, $y+1, $origem_x, $origem_y);
        // o arquivo � gravado
        if ($this->ext == "png")
            imagepng($img_final, $this->destino);
        elseif ($this->ext == "jpg")
            imagejpeg($img_final, $this->destino);
    }
    
    // cria uma imagem a partir do arquivo de origem
    private function createImg()
    {
        // imagem de origem
        if ($this->ext == "png")
            $img_origem= imagecreatefrompng($this->origem);
        elseif ($this->ext == "jpg" || $this->ext == "jpeg")
            $img_origem= imagecreatefromjpeg($this->origem);
        return $img_origem;
    }
    
    // obt�m a extens�o do arquivo
    private function getExtension($imagem)
    {
        // isso � para obter o mime-type da imagem.
        $mime= getimagesize($imagem);

        if ($mime[2] == 2)
        {
           $ext= "jpg";
           return $ext;
        }
        else
        if ($mime[2] == 3)
        {
           $ext= "png";
           return $ext;
        }
        else
           return false;
    }
    
    // mensagem de erro
    public function getErrorMsg()
    {
        return $this->errormsg;
    }
    
    public function isError()
    {
        return $this->errflag;
    }
}
?>
