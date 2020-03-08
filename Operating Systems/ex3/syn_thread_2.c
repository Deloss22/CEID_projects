#include <unistd.h>
#include <stdio.h>
#include <sys/types.h>
#include "display.h"
#include <sys/ipc.h>
#include <pthread.h>
#include <stdlib.h>

void *func1(void *myvar);
void *func2(void *myvar);
pthread_mutex_t mutex = PTHREAD_MUTEX_INITIALIZER;
pthread_cond_t cond = PTHREAD_COND_INITIALIZER;

int main(int argc, char *argv[])
{
	pthread_mutex_t mutex = PTHREAD_MUTEX_INITIALIZER;
	pthread_t thread1, thread2;
	char *var1 = "ab";
	char *var2 = "cd\n";

	pthread_create(&thread1, NULL, func1, (void *) var1);
	pthread_create(&thread2, NULL, func2, (void *) var2);

	pthread_join(thread1, NULL);
	pthread_join(thread2, NULL);
	pthread_mutex_destroy(&mutex);
	pthread_cond_destroy(&cond);

exit(0);
}

void *func1(void *myvar)
{
	pthread_mutex_lock(&mutex);
	char *var;
	var = (char *) myvar;
	int i;
	for (i=0;i<10;i++)
	{
	display(var);
	pthread_cond_signal(&cond);
	pthread_cond_wait(&cond,&mutex);
	}
	pthread_mutex_unlock(&mutex);
return NULL;
}

void *func2(void *myvar)
{
	pthread_mutex_lock(&mutex);
	char *var;
	var = (char *) myvar;
	int i;
	for (i=0;i<10;i++)
	{
	pthread_cond_wait(&cond,&mutex);
	display(var);
	pthread_cond_signal(&cond);
	}
	pthread_mutex_unlock(&mutex);
return NULL;
}
