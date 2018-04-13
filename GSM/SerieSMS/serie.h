/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* 
 * File:   serie.h
 * Author: kchevalier
 *
 * Created on 10 avril 2018, 16:46
 */

#ifndef SERIE_H
#define SERIE_H

#ifdef __cplusplus
extern "C" {
#endif

#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <fcntl.h>
#include <errno.h>
#include <termios.h>
#include <sys/ioctl.h>

int  ouvrirSerie(const char *device);
void configurerSerie (int fd, const int baud);
void recevoirChaine(int fd, char *message, char fin);
void flush (const int fd);
void envoyerUnCaratere (const int fd, const unsigned char c);
void envoyerChaine (const int fd, const char *s);


#ifdef __cplusplus
}
#endif

#endif /* SERIE_H */

