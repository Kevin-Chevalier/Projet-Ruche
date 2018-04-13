/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* 
 * File:   main.c
 * Author: kchevalier
 *
 * Created on 10 avril 2018, 16:43
 */

#include <stdio.h>
#include <stdlib.h>
#include "serie.h"
#include <unistd.h>

/*
 * 
 */
int main(int argc, char** argv) {

    int  fd, i;
    char message[255],reponse[255]="OK";
    int strcmp(const char *str1, const char *str2);
    
    system("clear");
    printf("Ouverture du port\n");
    fd = ouvrirSerie("/dev/ttyUSB0");
    configurerSerie(fd, 115200);
    //envoyerChaine(fd, "ATE0\n");
    //recevoirChaine(fd, message, 10);
    //printf("%s",message);
    printf("Fin de configuration\n");
    envoyerChaine(fd, "AT\n");
    //recevoirChaine(fd, message,10);
    //while (reponse != message)
    //while ( ok == message )
    //    {
    //printf("Procedure de test : %s", message);
    //printf("%d : %s", i, message);
    //printf("Activation de la carte sim\n");
    //envoyerChaine(fd, "AT+CPIN=\"0000\"\n");
    //sleep(2000);
    
    //recevoirChaine(fd, message, '\n');
    printf("Activation de l'envoie de SMS\n");
    envoyerChaine(fd, "AT+CMGF=1\n");
    //recevoirChaine(fd, message, 10);
    sprintf(message,"AT+CMGS=\"+0658280206\" \n Fonctionnement %c\n",26);
    envoyerChaine(fd, message);
    printf("%s", message);
    //    }
    return 0;
}
