<?php

namespace App\Models;

use Core\Model;
use Core\Alert;
use Core\Session;
use Core\Helpers as Helper;
use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class registerModel extends Model
{

	private $table = 'users';

	private $attributes = ['name', 'email', 'password', 'key_confirmation'];

	public function register(array $attributes = [])
	{
		$columns = implode(',', $this->attributes);
		$password = password_hash($attributes[2], PASSWORD_DEFAULT);
		$email = strtolower($attributes[1]);
		$key_confirmation = md5(time());
		
		$stmt = $this->conn->prepare("INSERT INTO users({$columns}) VALUES (:name, :email, :password, :key_confirmation)");
		$stmt->bindParam(':name', $attributes[0], PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':key_confirmation', $key_confirmation, PDO::PARAM_STR);
		$stmt->execute();

		$id = parent::getLAstId($this->table);
		Session::set('user', $this->find('users', $id, ['id', 'name', 'email']));
		Session::set('confirmed', 0);

		$this->confirmationEmail($key_confirmation, $attributes[0], $email);
	}

	private function confirmationEmail(string $key_confirmation, string $name, string $email)
	{
		$mail = new PHPMailer(true);
		//Server settings
	    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
	    $mail->isSMTP();                                            // Set mailer to use SMTP
	    $mail->Host       = HOST;  // Specify main and backup SMTP servers
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = SMTP_USERNAME;                     // SMTP username
	    $mail->Password   = SMTP_PASSWORD;                               // SMTP password
	    $mail->SMTPSecure = SMTP_SECURE;                                  // Enable TLS encryption, `ssl` also accepted
	    $mail->Port       = PORT;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom(SET_FROM[0], SET_FROM[1]);
	    $mail->addAddress($email, $name);     // Add a recipient

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Confirmation email';
	    $mail->Body    = sprintf('<p>Thank you very much for registering</p> We need you to enter the following link: %s to verify your email', BASE_URL.'user/confirmation/?key='.$key_confirmation);
	    $mail->send();
	}

}