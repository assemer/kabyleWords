import re
import mysql.connector

mydb = mysql.connector.connect(
  host="127.0.0.1",
  user="jef",
  password="",
  database="kabyleWords"
)

mycursor = mydb.cursor()


text = open('adris.txt',"r").read();
x = re.sub("[0-9\"'.;:?!\[\](),«»<>“”…*/’‘+&^%$#@–]", "", text).replace('\n', " ")

words = x.split(' ')

word_saved = []

for x in words:
	x = x.lower()

	if len(x) > 1:
		if x not in word_saved:
			if x[-1:] == 'e':
				continue
			word_saved.append(x)


 
words_added = 0

for v in range(len(word_saved)-1):
	mycursor.execute("SELECT * FROM words WHERE tamazight='"+str(word_saved[v])+"' LIMIT 1")	
	ans = mycursor.fetchall()
	if len(ans) == 0:
		req = "INSERT INTO words(tamazight,backWord,frontWord) VALUES ('"+word_saved[v]+"','"+word_saved[v-1]+"','"+word_saved[v+1]+"');"
		print(f"Adding New Words : [{word_saved[v-1]}] {word_saved[v]} [{word_saved[v+1]}]")
		mycursor.execute(req)
		mydb.commit()
		words_added = words_added+1


print(f"{len(word_saved)} Words Saved \nAdded On DB {words_added}")
g=str(words_added*100/len(word_saved))
print(f"APRRIE {g}%")