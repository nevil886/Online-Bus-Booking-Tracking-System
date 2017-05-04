<?php

class Database extends PDO {

    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
    }

    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function insert($table, $data) {
        $this->beginTransaction();
        try {
            ksort($data);
            $fieldNames = implode('`, `', array_keys($data));
            $fieldValues = ':' . implode(', :', array_keys($data));
//            echo "INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)";
//            exit();
            $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

            foreach ($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }
            $val = $sth->execute();
            $this->commit();
            return $val;
        } catch (Exception $e) {
            $this->rollBack();
            return $e->getMessage();
        }
    }

    public function traInsert($arrayData) {
        $this->beginTransaction();

        try {
            foreach ($arrayData as $key => $value) {
                $table = $value['table'];
                $data = $value['data'];
                ksort($data);
                $fieldNames = implode('`, `', array_keys($data));
                $fieldValues = ':' . implode(', :', array_keys($data));

//                echo "INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)".'<br/>';
//                exit();

                $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

                foreach ($data as $key => $value) {
                    $sth->bindValue(":$key", $value);
                }
                $val = $sth->execute();
            }
            $this->commit();
            return $val;
        } catch (Exception $e) {
            $this->rollBack();
            return $e->getMessage();
        }
    }

    /**
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public function update($table, $data, $where) {
        $this->beginTransaction();
        try {
            ksort($data);

            $fieldDetails = NULL;
            foreach ($data as $key => $value) {
                $fieldDetails .= "`$key`=:$key,";
            }
            $fieldDetails = rtrim($fieldDetails, ',');

//                echo "UPDATE $table SET $fieldDetails WHERE $where";
//                exit();
            $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

            foreach ($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }

            $val = $sth->execute();
            $this->commit();
            return $val;
        } catch (Exception $e) {
            $this->rollBack();
            return $e->getMessage();
        }
    }

    public function traupdate($arraydata) {
        $this->beginTransaction();
        try {

            foreach ($arraydata as $key => $value) {
                $table = $value['table'];
                $data = $value['data'];
                $where = $value['where'];

                ksort($data);
                $fieldDetails = NULL;
                foreach ($data as $key => $value) {
                    $fieldDetails .= "`$key`=:$key,";
                }
                $fieldDetails = rtrim($fieldDetails, ',');

//                echo "UPDATE $table SET $fieldDetails WHERE $where";
//                exit();
                $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

                foreach ($data as $key => $value) {
                    $sth->bindValue(":$key", $value);
                }
                $val = $sth->execute();
            }

            $this->commit();
            return $val;
        } catch (Exception $e) {
            $this->rollBack();
            return $e->getMessage();
        }
    }

    public function update_and_insert($table_u, $data_u, $where_u, $table_i, $data_i) {
        $this->beginTransaction();
        try {
            ksort($data_u);
            $fieldDetails = NULL;
            foreach ($data_u as $key => $value) {
                $fieldDetails .= "`$key`=:$key,";
            }
            $fieldDetails = rtrim($fieldDetails, ',');
//                echo "UPDATE $table_u SET $fieldDetails WHERE $where_u";
//                exit();
            $sth_u = $this->prepare("UPDATE $table_u SET $fieldDetails WHERE $where_u");
            foreach ($data_u as $key => $value) {
                $sth_u->bindValue(":$key", $value);
            }
            $val = $sth_u->execute();

            ksort($data_i);
            $fieldNames = implode('`, `', array_keys($data_i));
            $fieldValues = ':' . implode(', :', array_keys($data_i));
//            echo "INSERT INTO $table_i (`$fieldNames`) VALUES ($fieldValues)";
//            exit();
            $sth_i = $this->prepare("INSERT INTO $table_i (`$fieldNames`) VALUES ($fieldValues)");

            foreach ($data_i as $key => $value) {
                $sth_i->bindValue(":$key", $value);
            }
            $val = $sth_i->execute();

            $this->commit();
            return $val;
        } catch (Exception $e) {
            $this->rollBack();
            return $e->getMessage();
        }
    }

    public function trainsert_and_traupdate($arrayData_i, $arraydata_u) {
        $this->beginTransaction();
        try {
            //-----insert-------
            foreach ($arrayData_i as $key => $value_i_1) {
                $table_i = $value_i_1['table'];
                $data_i = $value_i_1['data'];
                ksort($data_i);
                $fieldNames = implode('`, `', array_keys($data_i));
                $fieldValues = ':' . implode(', :', array_keys($data_i));

//                echo "INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)".'<br/>';
//                exit();

                $sth_i = $this->prepare("INSERT INTO $table_i (`$fieldNames`) VALUES ($fieldValues)");

                foreach ($data_i as $key => $value_i_2) {
                    $sth_i->bindValue(":$key", $value_i_2);
                }
                $val_i = $sth_i->execute();
            }
            //----update---------
            foreach ($arraydata_u as $key => $value_u_1) {
                $table_u = $value_u_1['table'];
                $data_u = $value_u_1['data'];
                $where_u = $value_u_1['where'];

                ksort($data_u);
                $fieldDetails_u = NULL;
                foreach ($data_u as $key => $value_u_2) {
                    $fieldDetails_u .= "`$key`=:$key,";
                }
                $fieldDetails_u = rtrim($fieldDetails_u, ',');

//                echo "UPDATE $table SET $fieldDetails WHERE $where";
//                exit();
                $sth_u = $this->prepare("UPDATE $table_u SET $fieldDetails_u WHERE $where_u");

                foreach ($data_u as $key => $value_u_3) {
                    $sth_u->bindValue(":$key", $value_u_3);
                }
                $val_u = $sth_u->execute();
            }

            $this->commit();
            return $val_i.$val_u;
        } catch (Exception $e) {
            $this->rollBack();
            return $e->getMessage();
        }
    }

    /**
     * delete
     * 
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
    public function delete($table, $where, $limit = 1) {
        $this->beginTransaction();
        try {
            $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
            return $this->commit();
        } catch (Exception $e) {
            $this->rollBack();
            return $e->getMessage();
        }
    }

    public function delete_and_insert($table_d, $where_d, $table_i, $data_i) {
        $this->beginTransaction();
        $limit = 1;
        try {
            $this->exec("DELETE FROM $table_d WHERE $where_d LIMIT $limit");
            ksort($data_i);
            $fieldNames = implode('`, `', array_keys($data_i));
            $fieldValues = ':' . implode(', :', array_keys($data_i));
//            echo "INSERT INTO $table_i (`$fieldNames`) VALUES ($fieldValues)";
//            exit();
            $sth_i = $this->prepare("INSERT INTO $table_i (`$fieldNames`) VALUES ($fieldValues)");

            foreach ($data_i as $key => $value) {
                $sth_i->bindValue(":$key", $value);
            }
            $sth_i->execute();

            return $this->commit();
        } catch (Exception $e) {
            $this->rollBack();
            return $e->getMessage();
        }
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $sth = $this->prepare($sql);
//        echo $sql;
//        exit();
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }

        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }

}

?>