#PAPADOPOULOS PANTELIS
#1041854

#!/bin/bash

if [[ "$1" == "-f" && "$3" == "--edit" ]]; then
	if [[ "$5" -le 8 && "$5" -ge 2 ]]; then
	out="$(awk -v id="$4" -v col="$5" -v val="$6" 'BEGIN { FS=OFS="|" } $1 == id { $col = val } 1' $2 )"
	echo "$out" > $2
	else exit
	fi
elif [[ "$5" == "-f" && "$1" == "--edit" ]]; then
	if [[ "$3" -le 8 && "$3" -ge 2 ]]; then
	out="$(awk -v id="$2" -v col="$3" -v val="$4" 'BEGIN { FS=OFS="|" } $1 == id { $col = val } 1' $6 )"
	echo "$out" > $6
	else exit
	fi
elif [ "$1" == "--browsers" ]; then
	grep -v "^#" < $3 | awk -F '|' '{ print $8 }' | sort | uniq -c | tr -dc "[:print:]\n" | awk '{ print $2,$3,$1 }' | tr -s " "

elif [ "$3" == "--browsers" ]; then
	grep -v "^#" < $2 | awk -F '|' '{ print $8 }' | sort | uniq -c | tr -dc "[:print:]\n" | awk '{ print $2,$3,$1 }' | tr -s " "

elif [[ "$1" == "--born-since" && "$3" == "--born-until" && "$5" == "-f" ]]; then
	grep -v "#" < $6 | awk -F '|' -v dateA="$2" -v dateB="$4" '{if (FNR>1 && dateA<=$5 && dateB>=$5 ) {print}}'

elif [[ "$1" == "--born-until" && "$3" == "--born-since" && "$5" == "-f" ]]; then
	grep -v "#" < $6 | awk -F '|' -v dateA="$4" -v dateB="$2" '{if (FNR>1 && dateA<=$5 && dateB>=$5 ) {print}}'

elif [[ "$1" == "-f" && "$3" == "--born-until" && "$5" == "--born-since" ]]; then
	grep -v "#" < $2 | awk -F '|' -v dateA="$6" -v dateB="$4" '{if (FNR>1 && dateA<=$5 && dateB>=$5 ) {print}}'

elif [[ "$1" == "-f" && "$3" == "--born-since" && "$5" == "--born-until" ]]; then
	grep -v "#" < $2 | awk -F '|' -v dateA="$4" -v dateB="$6" '{if (FNR>1 && dateA<=$5 && dateB>=$5 ) {print}}'

elif [[ "$1" == "--born-since" && "$3" == "-f" && "$5" == "--born-until" ]]; then
	grep -v "#" < $4 | awk -F '|' -v dateA="$2" -v dateB="$6" '{if (FNR>1 && dateA<=$5 && dateB>=$5 ) {print}}'

elif [[ "$1" == "--born-until" && "$3" == "-f" && "$5" == "--born-since" ]]; then
	grep -v "#" < $4 | awk -F '|' -v dateA="$6" -v dateB="$2" '{if (FNR>1 && dateA<=$5 && dateB>=$5 ) {print}}'

elif [[ "$1" == "--born-since" && "$3" == "-f" && -z "$5" ]]; then
	grep -v "#" < $4 | awk -F '|' -v dateA="$2" '{if (FNR>1 && dateA<=$5 ) {print}}'

elif [[ "$1" == "-f" && "$3" == "--born-since" && -z "$5" ]]; then
	grep -v "#" < $2 | awk -F '|' -v dateA="$4" '{if (FNR>1 && dateA<=$5 ) {print}}'

elif [[ "$1" == "--born-until" && "$3" == "-f" && -z "$5" ]]; then
	grep -v "#" < $4 | awk -F '|' -v dateB="$2" '{if (FNR>1 && dateB>=$5 ) {print}}'

elif [[ "$1" == "-f" && "$3" == "--born-until" && -z "$5" ]]; then
	grep -v "#" < $2 | awk -F '|' -v dateB="$4" '{if (FNR>1 && dateB>=$5 ) {print}}'

elif [[ "$1" == "--lastnames" && "$2" == "-f" ]]; then
	grep -v "#" < $3 |  awk -F'|' '{ print $2 }' | sort -t '|' -k 2 | uniq

elif [[ "$3" == "--lastnames" && "$1" == "-f" ]]; then
	grep -v "#" < $2 |  awk -F'|' '{ print $2 }' | sort -t '|' -k 2 | uniq
 
elif [[ "$1" == "--firstnames" && "$2" == "-f" ]]; then
	grep -v "#" < $3 | awk -F'|' '{ print $3 }' | sort -t '|' -k 3 | uniq

elif [[ "$3" == "--firstnames" && "$1" == "-f" ]]; then
	grep -v "#" < $2 |  awk -F'|' '{ print $3 }' | sort -t '|' -k 3 |uniq

elif [[ "$1" == "-f" && "$3" == "-id" ]]; then
	awk -F'|' '$1 == '$4' { print $3, $2, $5 }' < "$2"

elif [[ "$1" == "-id" && "$3" == "-f" ]]; then
	awk -F'|' '$1 == '$2' { print $3, $2, $5 }' < "$4"

elif [[ "$1" == "-f" && -z "$3" ]]; then
	grep -v "#" < $2

else
	echo "1041854"
fi

#To sigkekrimeno script einai ftiagmeno gia na emfanizei, na epeksergazetai kai na anazitei se ena arxeio tis morfis 

#id|lastName|firstName|gender|birthday|creationDate|locationIP|browserUsed

#A) Trexontas tin entoli ./tool.sh -f <file> emfanizei olokliro to arxeio <file> xwris kanena sxolio.
#B) Trexontas tin entoli ./tool.sh -f <file> -id <id> emfanizei ton xristi(onoma, epitheto, imerominia gennisis) me to sigkekrimeno <id> ean
#uparxei.
#C) Trexontas tin entoli ./tool.sh --firstnames -f <file> emfanizei ola ta diakrita (unique) onomata xristwn tou epilegmenou arxeiou <file>.
#D) Trexontas tin entoli ./tool.sh --lastnames -f <file> emfanizei ola ta diakrita (unique) epitheta xristwn tou epilegmenou arxeiou <file>.
#E) Trexontas tin entoli ./tool.sh --born-since <dateA> --born-until <dateB> -f <file> emfanizei ola ta stoixeia twn xristwn pou exoun #gennithei apo <dateA> ews <dateB>.
#F) Trexontas tin entoli ./tool.sh --browsers -f <file> emfanizei tous web-browsers pou xrisimopoiountai kathos kai ton arithmo twn xristwn #tou kathenos.
#G) Trexontas tin entoli ./tool.sh -f <file> --edit <id> <column> <value> to script antikathista sto dwthen arxeio <file> to <column> (tou #xristi me tin <id>) tin timi <value>.

#Oi parapanw entoles mporoun na dothoun me opoiadipote seira (p.x. ./tool.sh -f <file> -id <id> == ./tool -f <file> -id <id>) arkei :
#-Sta -f <file>, -id <id>, --born-since <dateA>, --born-since <dateB> kai --edit <id> <column> <value> na min allaxthei i seira tous.

#Episis o arithmos column prepei na einai apo to 2 ews kai to 8. Ean dothei kati allo to epilegmeno arxeio <file> tha meinei anepafo.

