def max_value(a, b):
   return a if (a > b) else b

def find_max(arr):
    if len(arr) == 0:
        return None
    if len(arr) == 1:
        return arr[0]
    
    mid = len(arr) // 2
    
    max_left = find_max(arr[:mid])
    max_right = find_max(arr[mid:])
    
    return max_value(max_left, max_right)

# CONTOH
arr = [1, 65, 34, 2, 4, -9, 0]
print("Mencari Nilai Maks secara paralel: ", find_max(arr))