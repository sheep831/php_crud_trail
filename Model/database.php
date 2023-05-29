<?php
class Database
{
    protected $connection = null;
    public function __construct()
    {   // Create connection
        try {
            $this->connection = new mysqli("localhost", "root", "", "hello_world");
    	
            if ( mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");   
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }			
    }



    public function select($query = "" , $params = []) 
    {
        try {   // Perform queries
            $stmt = $this->executeStatement( $query , $params );    // Fetch result
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);	// Free result set			
            $stmt->close();  // Close connection
            return $result; 
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    private function executeStatement($query = "" , $params = [])   
    {
        try {   // Prepare statement
            $stmt = $this->connection->prepare( $query );   // Bind parameters
            if($stmt === false) { // check if any error occured
                throw New Exception("Unable to do prepared statement: " . $query);
            }
            if( $params ) { // check if any parameters are passed
                $stmt->bind_param($params[0], $params[1]);
            }
            $stmt->execute(); 
            return $stmt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }	
    }
}