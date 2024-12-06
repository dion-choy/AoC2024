def main():
    arr = []

    count = 0
    with open("./day4.txt", "r", ) as file:
        for line in file:
            line = line.strip()
            arr.append(list(line))

            count += line.count("XMAS")
            count += line.count("SAMX")
    
    for line in transStr(arr):
        count += line.count("XMAS")
        count += line.count("SAMX")

    upLeft = []
    for i, line in enumerate(arr):
        tempLine = i*[" "]
        tempLine.extend(line)
        tempLine.extend((len(line)-i-1)*[" "])
        upLeft.append(tempLine)
    for line in transStr(upLeft):
        count += line.count("XMAS")
        count += line.count("SAMX")

    upRight = []
    for i, line in enumerate(arr):
        tempLine = (len(line)-i-1)*[" "]
        tempLine.extend(line)
        tempLine.extend(i*[" "])
        upRight.append(tempLine)
    for line in transStr(upRight):
        count += line.count("XMAS")
        count += line.count("SAMX")
    
    print(count)

def transStr(inList: list):
    return map(lambda line : "".join(line), zip(*inList))

if __name__ == "__main__":
    main()