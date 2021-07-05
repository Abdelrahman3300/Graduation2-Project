from pandas import read_csv
from pandas import datetime
from matplotlib import pyplot
from statsmodels.tsa.arima_model import ARIMA
from sklearn.metrics import mean_squared_error
from math import sqrt
from pandas import DataFrame
from pandas.plotting import autocorrelation_plot
#import requests
#import sqlite3

#conn = sqlite3.connect('lightfild.db')

#c = conn.cursor()

#from flask import Flask
#@app.route("/FARIMA",methods=['GET'])
#app = Flask(__name__)
# if (__name__=="__main__")
# app.run()
     
#def Forecasting() :
#


#def parser(x):
#	return datetime.strptime('190'+x, '%Y-%m')
	
# series = c.execute("""SELECT * FROM sales()""")

series = read_csv('Testf.csv', header=0, index_col=0, parse_dates=True, squeeze=True)
X = series.values
autocorrelation_plot(series)
size = int(len(X) * 0.66)
train, test = X[0:size], X[size:len(X)]
history = [x for x in train]
predictions = list()

for t in range(len(test)):
	model = ARIMA(history, order=(2,1,0))
	model_fit = model.fit()
	output = model_fit.forecast()
	yhat = output[0]
	predictions.append(yhat)
	obs = test[t]
	history.append(obs)
	print('predicted=%f, expected=%f' % (yhat, obs))
# evaluate forecasts
rmse = 100-sqrt(mean_squared_error(test, predictions))
print('Test RMSE: %.3f' % rmse)
# save model
model_fit.save('model1.pkl')
#test.save('test.pkl')
#load mode
#loaded = ARIMAResults.load('model.pkl')
pyplot.plot(test)
pyplot.show()
pyplot.plot(predictions)
pyplot.show()
