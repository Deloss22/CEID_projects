#include <unistd.h>
#include <sys/types.h>
#include <sys/wait.h>
#include "display.h"
#include <sys/ipc.h>
#include <sys/sem.h>

int main()
{
  int i, sem1;
struct sembuf up = {0, 1, 0};
struct sembuf down = {0, -1, 0};
sem1 = semget(IPC_PRIVATE, 1, 0600);

 if (fork())
 {
	for (i=0;i<10;i++)
	{
		semop(sem1, &down, 1);
		display("ab");
		semop(sem1, &up, 1);
	}
	wait(NULL);
 }
 else
 {
	for (i=0;i<10;i++)
	{
		semop(sem1, &up, 1);
		semop(sem1, &down, 1);
		display("cd\n");
	}
 }
	semctl(sem1, 0, IPC_RMID);
 return 0;
}
