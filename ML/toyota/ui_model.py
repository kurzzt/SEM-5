import pickle
import streamlit as st


model = pickle.load(open('ML/toyota/predict_model.sav', 'rb'))

st.title('Prediksi Harga Mobil berdasarkan inputan')

year = st.number_input('Input Tahun Mobil')
mileage = st.number_input('Input Km Mobil')
tax = st.number_input('Input Pajak Mobil')
mpg = st.number_input('Input Konsumsi BBM Mobil')
engineSize = st.number_input('Input Engine Size')

predict = ''

if st.button('Prediksi Harga'):
  predict = model.predict(
    [[year, mileage, tax, mpg, engineSize]]
  )

  st.write('Prediksi Harga mobil bekas dalam ponds : ', predict)
  st.write('Prediksi Harga mobil bekas dalam idr (Juta) : ', predict*19000)