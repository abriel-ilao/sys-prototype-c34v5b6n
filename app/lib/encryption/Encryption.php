<?php 

namespace app\lib\encryption 
{

class Encryption {
     /**
     * Encrypt and decrypt
     * 
     * @author Nazmul Ahsan <n.mukto@gmail.com>
     * @link http://nazmulahsan.me/simple-two-way-function-encrypt-decrypt-string/
     *
     * @param string $string string to be encrypted/decrypted
     * @param string $action what to do with this? e for encrypt, d for decrypt
     */

    public static function Simple_crypt( $string, $action = 'e' ) {
        // you may change these values to your own
        $secret_key = 'my_simple_secret_key';
        $secret_iv = 'my_simple_secret_iv';
     
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
     
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
     
        return $output;
    }

    //echo $encrypted = my_simple_crypt($id, 'e' ).'<br>';
    //echo $decrypted = my_simple_crypt($id, 'd' );

    /*
    $expected  = crypt('1', 'salt');
    $correct   = crypt('1', 'salt');
    $incorrect = crypt('apple',  '$2a$07$usesomesillystringforsalt$');

    var_dump(hash_equals($expected, $correct));
    var_dump(hash_equals($expected, $incorrect));

    if(hash_equals($expected, $correct))
    {
        echo 'hello';
    } else {
        echo 'not true';
    }
    */
    }
}