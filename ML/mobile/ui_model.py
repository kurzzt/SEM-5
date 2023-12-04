import pickle
import streamlit as st
import numpy as np


model = pickle.load(open('./ML/mobile/predict_model.sav', 'rb'))

st.title('Prediksi Rentang Harga Gawai berdasarkan inputan')

# battery_power, blue, clock_speed,
# dual_sim, fc, four_g,
# int_memory, m_dep, mobile_wt,
# n_cores, pc, px_height,
# px_width, ram, sc_h,
# sc_w, talk_time, three_g,
# touch_screen, wifi

def boolean_input(x):
  return 1 if x[:3] == 'Its' else 0

# Inputan
# int_memory_options = np.power(2, np.arange(1, 7))

battery_power = st.number_input('Input Battery Power', 200, 2000)
blue = st.radio('Bluetooth or not', ['Its Bluetooth', 'Not Bluetooth'], horizontal=True)
clock_speed = st.slider('Input Clock Speed', 0.0, 3.0, step=0.1)
dual_sim = st.radio('Dual SIM or not',  ['Its Dual SIM', 'Not Dual SIM'], horizontal=True)
fc = st.number_input('Input Front Camera in megapixels', 0, 20)
four_g = st.radio('4G or not',  ['Its 4G', 'Not 4G'], horizontal=True)
int_memory = st.slider('Input Internal Memory', 0, 64)
m_dep = st.slider('Input Mobile Depth', 0.0, 1.0, step=0.1)
mobile_wt = st.slider('Input Mobile Weight', 50, 250)
n_cores = st.slider('Input Number of Cores', 1, 8)
pc = st.number_input('Input Primary Camera in megapixels', 0, 20)
px_height = st.number_input('Input Pixel Resolution Height', 0, 2000)
px_width = st.number_input('Input Pixel Resolution Width', 0, 2000)
ram = st.number_input('Input RAM in MB')
sc_h = st.slider('Input Screen Height of mobile in cm', 0, 20)
sc_w = st.slider('Input Screen Width of mobile in cm', 0, 20)
talk_time = st.slider('Input Longest time to talk on full charge in hour', 0, 20)
three_g = st.radio('3G or not',  ['Its 3G', 'Not 3G'], horizontal=True)
touch_screen = st.radio('Touch Screen or not',  ['Its Touch Screen', 'Not Touch Screen'], horizontal=True)
wifi = st.radio('WiFi or not',  ['Its WiFi', 'Not WiFi'], horizontal=True)

predict = ''

if st.button('Prediksi Rentang Harga'):
  predict = model.predict(
    [[
      battery_power, boolean_input(blue), clock_speed,
      boolean_input(dual_sim), fc, boolean_input(four_g),
      int_memory, m_dep, mobile_wt,
      n_cores, pc, px_height,
      px_width, ram, sc_h,
      sc_w, talk_time, boolean_input(three_g),
      boolean_input(touch_screen), boolean_input(wifi)
    ]]
    # [[n_cores, boolean_input(blue), 
    #   boolean_input(dual_sim), 
    #   boolean_input(four_g), 
    #   boolean_input(three_g), 
    #   boolean_input(touch_screen), 
    #   boolean_input(wifi)
    # ]]
  )

  st.write('Prediksi Rentang Harga Gawai : ', predict)

  # st.write('Debug', boolean_input(blue), blue, dual_sim, four_g,boolean_input(three_g), three_g, touch_screen, wifi)