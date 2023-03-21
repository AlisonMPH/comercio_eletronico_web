
<?php

    Upload();
    
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    
    function Upload()
    {
    
        $imagem_temp = basename($_FILES["fileToUpload"]["tmp_name"]);
        $imagem_enviada = basename($_FILES["fileToUpload"]["name"]);
        
        
        // Check if image file is a actual image or fake image 
        $conteudo_eh_imagem = Verifica_Conteudo($imagem_temp);
        
        // Check if file already exists
        $eh_arquivo_novo = Verifica_Duplicidade($imagem_enviada);
        
        // Check file size
        $tamanho_obedecido = Verifica_Tamanho_Maximo();
        
        // Allow certain file formats
        $tipo_valido = Verifica_Tipo( $imagem_enviada );
        
        // Check if $uploadOk is set to 0 by an error
        if ( $conteudo_eh_imagem && $eh_arquivo_novo && $tamanho_obedecido && $tipo_valido )
        {
            Copia_Arquivo($imagem_enviada );
        }
    }
    
    // *************************************************************************
    function Verifica_Conteudo( $imagem_temp )
    {
        list($largura, $altura, $tipo, $atributos) = getimagesize($imagem_temp);
        
        echo "Verifica_Conteudo(): ".( $largura )."<br>";
        return ( getimagesize( $imagem_temp ) != false );
    }
    
    // *************************************************************************
    function Verifica_Duplicidade( $imagem_enviada )
    {
        echo "Verifica_Duplicidade(): ".( ! file_exists($imagem_enviada) )."<br>";
        return ( ! file_exists($imagem_enviada) );
    }
    
    // *************************************************************************
    function Verifica_Tamanho_Maximo()
    {
        $limite_tamanho = 500000; // tamanho em bytes
        
        echo "Verifica_Tamanho_Maximo(): ".( $_FILES["fileToUpload"]["size"] <= $limite_tamanho )."<br>";
        return ( $_FILES["fileToUpload"]["size"] <= $limite_tamanho );
    }
    
    // *************************************************************************
    function Verifica_Tipo( $imagem_enviada )
    {
        $TIPOS_PERMITIDOS = array("jpg", "jpeg", "jfif", "png");
        
        $tipo_imagem = strtolower(pathinfo($imagem_enviada,PATHINFO_EXTENSION));
        
        echo "Verifica_Tipo(): ".in_array( $tipo_imagem, $TIPOS_PERMITIDOS )."<br>";
        return in_array( $tipo_imagem, $TIPOS_PERMITIDOS );
    }
    
    // *************************************************************************
    function Copia_Arquivo( $imagem_enviada )
    {
        $imagem_enviada = "uploads/" . $imagem_enviada;
        
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $imagem_enviada);
    }    

?>