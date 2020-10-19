<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use PDO;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pdo = DB::connection()->getPdo();
        $stmt = $pdo->prepare("SELECT * FROM client");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $pdo = null;

        //return view clientes
        return view('clientes', ["clients" => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //form for create a new client
        return view('cliente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        try{
                //get all parameters of the new client 
                $list_email = $request->input("email"); 
                $list_tel = $request->input("tel");
                $size_email = sizeof($list_email); 
                $size_tel = sizeof($list_tel);
                $name = $request->input("nome");
            
                //insert client with the status = true (1)
                $pdo = DB::connection()->getPdo();
                $stmt =  $pdo->prepare("INSERT INTO client(name, status) VALUES(:name, :status)");
                $stmt->bindValue(':name', $name);
                $stmt->bindValue(':status', 1);
                
                if($stmt->execute()){                
                    
                    //get id of client
                    $id_client = $pdo->lastInsertId();                    

                    if($size_tel > 0){
                        foreach($list_tel as $tel){
                            //insert all tel
                            $sql = "INSERT INTO tel_client(tel, client_code) VALUES(:tel, :client_code)";
                            $stmt =  $pdo->prepare($sql);
                            $stmt->bindValue(':client_code', $id_client);
                            $stmt->bindValue(':tel', $tel);                        
                            $stmt->execute();                         
                        }
                    }
                    
                    if($size_email > 0){                    
                        foreach($list_email as $email){
                            //insert all email
                            $stmt =  $pdo->prepare("INSERT INTO email_client(client_code, email) VALUES(:client_code, :email)");
                            $stmt->bindValue(':client_code', $id_client);
                            $stmt->bindValue(':email', $email);                        
                            $stmt->execute();                  
                        }
                    }                
                }
                     
                return true;
        }catch(PDOException $e){
            echo "Erro ao inserir cliente ".$e->getMessage();    
        }finally{
            $pdo = null;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $pdo = DB::connection()->getPdo();
        
            //select a client finding for parameter id --------------------
            $stmt = $pdo->prepare("SELECT * FROM client WHERE id = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $cliente = $stmt->fetch(PDO::FETCH_OBJ);        

            //select the email of client ------------------------------------------------
            $stmt =  $pdo->prepare("SELECT ec.email, ec.id 
                                    FROM      client c, 
                                    email_client ec
                                    WHERE c.id = :id
                                    AND c.id = ec.client_code");

            $stmt->bindValue(':id', $id);
            
            if($stmt->execute()){
                $emails = $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            
            //select telphone of client -------------------------------------------------
            $stmt =  $pdo->prepare("SELECT tc.tel, tc.id FROM 
                                    client c, 
                                    tel_client tc
                                    WHERE c.id = :id
                                    AND c.id = tc.client_code;");

            $stmt->bindValue(':id', $id);

            if($stmt->execute()){
                $tels = $stmt->fetchAll(PDO::FETCH_OBJ);
            }

            //return view with all parameters of the client
            return view("cliente-edit", array('cliente' => $cliente, 'emails' => $emails, 'tels' => $tels));

        }catch(PDOException $e){
            echo "Erro ao inserir cliente ".$e->getMessage();    
        }finally{
            $pdo = null;
        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $pdo = DB::connection()->getPdo();
        
            $update = $request->input("update");        
            
            if($update === "cliente"){
                $name = $request->input("nome");
                $sql = "UPDATE client SET name = :name WHERE id = :id";
                $stmt =  $pdo->prepare($sql);
                $stmt->bindValue(':name', $name);
                $stmt->bindValue(':id', $id); 
            }else if($update === "email"){
                $email = $request->input("email");
                $sql = "UPDATE email_client SET email = :email WHERE id = :id";
                $stmt =  $pdo->prepare($sql);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':id', $id); 
            }else if($update === "tel"){
                $tel = $request->input("tel");
                $sql = "UPDATE tel_client SET tel = :tel WHERE id = :id";
                $stmt =  $pdo->prepare($sql);
                $stmt->bindValue(':tel', $tel);
                $stmt->bindValue(':id', $id); 
            }else{
                //Update status of the client (Event on click - Check Box)
                $status = $request->input("status");
                $sql = "UPDATE client SET status = :status WHERE id = :id";
                $stmt =  $pdo->prepare($sql);
                $stmt->bindValue(':status', $status);
                $stmt->bindValue(':id', $id);            
            }

            if($stmt->execute()){                            
                $pdo = null;
                return true; 
            }else{
                return false;
            } 

        }catch(PDOException $e){
            Echo "Message: ".$e;
        }finally{
            $pdo = null;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     *  @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try{            
            $pdo = DB::connection()->getPdo();
            $type = $request->input("type");

            if($type === "email"){
                $sql = "DELETE from email_client WHERE id = :id";
            }else if($type === "tel"){
                $sql = "DELETE from tel_client WHERE id = :id";
            }
            
            $stmt =  $pdo->prepare($sql);        
            $stmt->bindValue(':id', $id); 
            
            if($stmt->execute()){
                echo "Valor do Id = ".$id;
                return true;
            }else{
                return false;
            }

        }catch(PDOException $e){
            echo "".$e;
        }finally{
            $pdo = null;
        }
        
    }
}
