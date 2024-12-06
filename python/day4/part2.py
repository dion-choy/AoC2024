def main():
    arr = []

    count = 0
    with open("./day4.txt", "r", ) as file:
        for line in file:
            line = line.strip()
            arr.append(line)

    for i in range(1, len(arr)-1):
        for j in range(1, len(arr[i])-1):
            if arr[i][j] == 'A':
                if not ((arr[i-1][j-1] == 'M' and arr[i+1][j+1] == 'S') or (arr[i-1][j-1] == 'S' and arr[i+1][j+1] == 'M')):
                    continue

                if not ((arr[i-1][j+1] == 'M' and arr[i+1][j-1] == 'S') or (arr[i-1][j+1] == 'S' and arr[i+1][j-1] == 'M')):
                    continue
                
                count += 1
    
    print(count)

if __name__ == "__main__":
    main()