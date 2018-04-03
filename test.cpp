
/*************************************************************************
  Sujet	: Programme pour enregistrer la valeur de la temperature
          dans la table temperature de la base de donn�es MySQL Valeurs
  langage   : C++
  Auteur 	: Chevalier Kevin
  Date   	: 30 mars 2018
  Prérequis : sudo apt-get install libmysqlcppconn-dev
  Compilation :
               g++ test.cpp  -o test -lmysqlcppconn
  Execution : Pour executer périodiquement toutes les 10 minutes
              Ajouter avec crontab
*************************************************************************/
  //  */10 * * * * /home/pi/cplus/saveTemp

#include <iostream>
#include <sstream>
#include <iomanip>
#include "cppconn/driver.h"
#include "config.h"
#include "cppconn/connection.h"
#include <cppconn/statement.h>


using namespace std;
using namespace sql;

int main(int argc, char* argv[]) {

    Driver* driver;
    Connection* connection;
    Statement *stmt;
 

    driver = get_driver_instance();
    connection = driver -> connect(IPSERVEUR, UTILISATEUR, MDP);

    stmt = connection->createStatement();

    // selectionne la base de données ruche
    stmt->execute("USE ruche");

    // insertion d'une valeur dans la table temperature
    ostringstream sql;
    sql << "INSERT INTO mesures(date, tempval, ruches_idRuches) VALUES (CURRENT_TIMESTAMP," <<  51.00 << "," << IDRUCHE << ")";
    stmt->execute(sql.str());

    delete stmt;

    connection -> close();
    delete connection;
    cout << "Done bye" << endl;
    return 0;
}
