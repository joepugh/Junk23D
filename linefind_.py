import Image
import os
import math
import sys

theta = 13.5  ##Set the degrees from the camera
ctw = 228     ##In mm the distance from the center to the wall
Pw = 248      ## Pixal location of the wall
Pc = 190      ## Pixal location of the center

thelist = []

class prcone:
	height = 0
	def calxyz(this, Px, sliceangle, h): 
		mx = ((((Pw-Px)/math.sin(theta))*ctw)/((Pw-Pc)/math.sin(theta)))-ctw
		if mx > 0:
			return [math.sin(sliceangle)*(-1)*mx,math.cos(sliceangle)*(-1)*mx, (this.height-h)] #x= sin(rotated)*-1
		return 0

	def fileproc(this, dirrr ,sliceangle):
		image = Image.open(dirrr)

		rimage = image.split()[0]

		width = image.size[0]
		height = image.size[1]
		imstrm = rimage.getdata()
		top = []
		x=[]
		tval = []
		for h in range(height):
			localmax=0
			localx=0
			for w in range(width):
				currentv = imstrm[(h*width)+w]
				currentx = w
				if currentv > localmax:
					localmax = currentv
					localx = w
			if currentx > 70:
				tval.append(localmax)
				x.append(localx)
				hold = this.calxyz(localx, sliceangle, h)
				if hold:
					top.append(hold)
			else:
				tval.append(0)
				top.append(0)

		return top 

		rimage.show()

if __name__ == '__main__':
	if len(sys.argv) != 3:
		print sys.argv
		print "oh know I need 2 args,  the file path with the images and the file to write"
	else:
		dirrr = os.listdir(sys.argv[1])#get a list of files in the directory passed as the first argument
		dirrr.sort()
		poplist = [] #make an array to hold what files need not be processed
		for x in range(len(dirrr)):
			if not dirrr[x].endswith(".jpg"): #If a file is not a jpg then we don't want to process it.
				poplist.append(x-len(poplist)) #add the position of the non jpg file to the list but compensate for the files that will be removed first.
		for x in poplist:
			dirrr.pop(x)
		f = open(sys.argv[2], 'w') #make a new file with the name passed as arg 2
		
		for files in range(len(dirrr)):
			t = prcone() #make a new instance of prcone
			print str(sys.argv[1])
			print str(dirrr[files])

			thelist +=  t.fileproc(str(sys.argv[1])+'/'+str(dirrr[files]), math.radians(files*(3))) 

		f.write('o theobject\n') #name the object in the .obj file "theobject"
		
		for x in thelist:
			f.write('v ')
			for y in x:
				f.write(str(y)+" ")
			f.write("\n")