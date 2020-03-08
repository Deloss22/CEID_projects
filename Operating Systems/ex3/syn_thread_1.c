#include <unistd.h>
#include <stdio.h>
#include <sys/types.h>
#include <sys/wait.h>
#include "display.h"
#include <sys/ipc.h>
#include <sys/sem.h>
#include <pthread.h>
#include <stdlib.h>

void *func(void *myvar);
pthread_mutex_t mutex = PTHREAD_MUTEX_INITIALIZER;

int main(int argc, char *argv[])
{
	pthread_mutex_t mutex = PTHREAD_MUTEX_INITIALIZER;
	pthread_t thread1, thread2;
	char *var1 = "Hello world\n";
	char *var2 = "Kalimera kosme\n";

	pthread_create(&thread1, NULL, func, (void *) var1);
	pthread_create(&thread2, NULL, func, (void *) var2);

	pthread_join(thread1, NULL);
	pthread_join(thread2, NULL);
	pthread_mutex_destroy(&mutex);

exit(0);
}

void *func(void *myvar)
{
	pthread_mutex_lock(&mutex);
	char *var;
	var = (char *) myvar;
	int i;
	for (i=0;i<10;i++)
	{
		display(var);
	}
	pthread_mutex_unlock(&mutex);
return NULL;
}
