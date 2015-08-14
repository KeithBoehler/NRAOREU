# NRAOREU
PhP Library made at an internship at NRAO.
Amplitude stability plotting library in PHP and GNUPLOT
By: Keith Boehler (germanbohler@gmail.com)
Mentor: Morgan McLeod
Advisors: John Effland, Kamaljeet Sani

Abstract
The goal of this project was to develop software that will calculate the amplitude of stability of receivers, local oscillator, or measurement equipment. This program is written in an object oriented manner to modularize the code and facilitate maintenance with support from GNUPlot for plotting. Any computer or server with PHP 5 and GNUPlot 5 and above should be able run the program. The output will be a plot of Allan Variace versus time including axis labels, title, and a spec line. Generated plots must meet the Atacama Large Millimeter/Submillimeter Array (ALMA) Front End specification for amplitude stability.  Information from these plots will indicate when our instruments are most sensitive and when recalibration is needed. 

	Introduction 
The amplitude stability library is used to determine the stability of measurement equipment for ALMA meets certain specifications. This software was developed to use a statistical measurement called Allan Variance to determine sensitivity of equipment.   

	Program Overview 

The PHP code will be written in an object oriented manner to modularize the code. This helps facilitate the maintenance because future changes will only need to be done to one part of the program. The program has a user interface that allows the input of raw data as well as needed parameters for processing such as a delimiter. This information is passed on to a master program that will coordinate the efforts of specialized PHP classes (the source code for the library can be found at https://github.com/KeithBoehler/NRAOREU). 
There are two utility classes, fileWorker and arrayWorker, who aid in the handling of information. The fileWorker class manages where files are uploaded along with paths and unique filenames for output information. The class also extracts information from uploaded files into arrays and writes information from arrays to text files in a manner that GNUPlot can use.
There is an AllanCalc class that handles procedure for calculating the Allan Variace. This class will include averaging and organizing features that aide in calculation which is explained later in greater detail. 
There is a plotting class that will create a command file for GNUPlot to correctly display labels, legend, and spec lines (5×〖10〗^(-7)). The following figure outlines the classes, 







 


	Allan Variance

Allan Variance is a statistical measure developed by Dr. David Allan in a study about atomic clock stability. The equation is as follows, 
〖(1)   σ_normalized^2〗^ =1/(2(N-1) μ^2 ) ∑_(i=1)^N▒〖y_i (τ)-y_(i+1) (τ)〗
	N being the number of points in the data set
	Mu the average of said data set. 
	Tau is the integration time.
	y_i is the value of the ith sample. 
This method was used to deal with drift in mean and variance over a large population sample. It should be noted that this equation produces one point and will be looped over to generate the plot. 
The way Allan Variance is calculated depends on which point we are in (first, second, third, etc.) If we are on the first point we simple would use the equation (1) as seen above. For the second point we would average every two points and then proceed with the averages as we did for the first point. This pattern of averaging n number of points for the nth Allan Variance will continue until we have the points we need. Next it is necessary to normalize so that measurements taken at lower power levels do not appear to be less stable than those taken at higher levels. This is achieved simply multiplying every point by the factor( 1)⁄(2(N-1) μ^2 ). This factor does not have to be calculated for every single Allan Variance because calculating it for the large data set will be equivalent to that of several smaller sets. 
 

	Algorithm 
 

 
In the code the averaging of the original data set and normalizing factor have been pre-calculated and kept in memory in the interest of performance. Inside a loop there is a function that arranges and averages data, for clarity the function will be referred separately as organizer and averager, and a function that calculates the unnormalized Allan Variance.

The organizer has a task of rearranging the single dimension input array into a multidimensional array, somewhat like a spread sheet. The purpose is to facilitate averaging and conceptualize what is happening. Organizer will arrange data so that for the nth Allan Variance there will be n columns. Suppose we have an input array that looks something like this, 
p_1	p_2	p_3	p_4	p_5	p_6	p_7	p_8	p_n

The first run in this function will rearrange the array into one column. The second run two columns. The third run three and so forth, 

 


Once the data has been arranged in a spreadsheet manner like the general case the averaging function can simply run across averaging each row. This arrangement is for this function’s convenience and to avoid errors when picking how to group numbers for the averaging. This will make a new array of averages as illustrated by the following figure, 

 

This newly generated array of averages will be passed to a function that calculates the Allan Variance as explained above and illustrated in the next figure, 
 

This value will then be multiplied by the normalizing factor and added to an array that will later be used for plotting. 

	Results 

Plot One:
 

Plot Two: 
 
Plot Three: 
 
	Future Work 

In order for this project to be fully operational it will be necessary to add some security features such as restrictions on extensions, plot customizing features, and a garbage collector. A new class to calculate phase stability to present more information about the behavior of the system. It is also desirable to design a way so that the output to be displayed in a separate page. This is to keep working on generated text files instead of recalculating Variance and Phase if the user wants to change anything about the plot. The garbage collector will then delete temporary files once a desired plot has been made to keep an uncluttered server. The program can generate results that are on par with previously existing Python version, but it can still be improved by having more user input that allows greater flexibility and variety of plots. Further testing is needed to make sure that all delimiter options are functional . 

	Bibliography 

Sani, Kamaljeet. "Notes on the Measurement of Amplitude Stability (“Allan Variance” of Output Power) of the ALMA First LO Driver Assemblies." File on ALMA EDM (2004). Web. 1 July 2015. 
