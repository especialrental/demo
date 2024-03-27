<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;



class SendMail extends Mailable

{

    use Queueable, SerializesModels;

    public $data;

    /**

     * Create a new message instance.

     *

     * @return void

     */

    public function __construct($data)

    {

        $this->data = $data;
        $this->name = $data['name'];
        $this->email = $data['email'];
    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

        return $this->from($this->email)->replyTo($this->email,$this->name)->subject('New Customer Equiry')->view('dynamic_email_template')->with('data', $this->data);

    }

}



?>