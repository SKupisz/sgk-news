import tkinter as tk
from tkinter import ttk
import pymysql
import datetime
pymysql.install_as_MySQLdb()

class App(tk.Frame):
    def __init__(self,master=None):
        super().__init__(master)
        self.master = master
        self.master.config(bg="white")
        self.pack()
        self.rendering()
    def rendering(self):
        self.l1 = tk.Label(text="SGK-news bulletin panel") 
        self.l1.config(font=("Courier",30),width=100,bg="white")
        self.l1.pack(side="top")

        
        self.input = tk.Entry(self.master) 
        self.input.config(font=("Courier",11),bg="white",fg="black",width = 100
                          ,justify="center") 
        self.input.insert(0,"Title here")
        self.input.pack(side="top",anchor="w")


        self.content = tk.Text(self.master)
        self.content.config(font=("Courier",10),borderwidth=1,relief="solid"
                            ,width=90)
        self.content.pack()
        
        self.confirm = tk.Button(text="testOne")
        self.confirm.config(font=("Courier",11),width=40,
                            command=lambda: self.goForThat(),borderwidth=1,
                            relief="groove")
        self.confirm.place(relx=0.0, rely=0.0, anchor="nw")
        self.confirm.pack(side="top")
        
    def goForThat(self):
        title = self.input.get()
        content = self.content.get("1.0","end-1c")
        x = datetime.datetime.today()
        dateOfPublishing = x.strftime("%Y-%m-%d")
        db = pymysql.connect(host="localhost",user="root",passwd="",db="sgknews",autocommit=True)
        print(content.find("\n"))
        while(content.find("\n") != -1):
            marker = content.find("\n")
            content = content[:marker]+"<br>"+content[marker+1:]
        try:  
            cur = db.cursor()
            cur.execute("INSERT INTO bulletins VALUES(NULL,%s,%s,%s)",
                        (title,content,dateOfPublishing))
        except Exception as e:
            print("Exeception occured:{}".format(e))
        finally:
            self.input.delete(0, 'end')
            self.content.delete('1.0', "end")
            db.close()
root = tk.Tk()
app = App(master=root)
app.master.title("Bulletin panel")
app.master.geometry("800x600")
app.mainloop()
